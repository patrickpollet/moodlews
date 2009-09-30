<?php
// $Id: server.class.php,v 1.5.4 2007/05/02 04:05:36 ppollet Exp $
/**
 * Base class for web services server layer. PP 5 ONLY.
 *
 * @package Web Services
 * @version $Id: server.class.php,v 1.5 2007/04//26 04:05:36 ppollet Exp $
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca> v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5
 */
/* rev history
  1.5 released to Moodle forum
  1.5.1 :
    - make isteacherinanycourse Moodle 1.6 compatible
    - filtering events by type
    - function login :CAUTION : authenticate_user_login  WILL  create the user if
it does not exist AND the global authentication methods is not 'internal' (CAS, LDAP ...)
so anyone could get in and retrieve some 'public' informations. So we first check for
an existing account with internal auth method ! (a limitation that should be treated
but how to authenticate by CAS in this service ????)
 1.5.4 :
   - added an idfield and sort paramter to get_my_courses
   - in get_my_courses, if user is the guest user, process it differently .
   -
 1.5.6
   - fixed has_role_in_course to run with Moodle< 1.7
   - fixed  get_users_bycourse to run with Moodle < 1.7
   - filter_changes did not worked with user admin en Moodle 1.6
   - get_roles should not be called in Moodle <1.7
1.5.7
  - added a timestamp (integer) to returned changeRecord
1.5.8
  - fixed edit_users parameters passing and simplified code to update user
  - fixed edit-courses parameters passing and simplified code to update course
1.5.9
  - edit_users, add the new field  user->mnethostid = $CFG->mnet_localhost_id for Moodle >= 1.8
    see http://moodle.org/mod/forum/post.php?reply=376117

1.5.10
  - bug in get_my_courses when uinfo is Moodle id
1.5.11
  - previous empty default value for $sort in get_my_courses raises an SQL error. Changed to fullname
1.5.13
  - added get_resources operation
  - first attempt to get_instances_bytype
1.5.14
  - bug in filter_course in Moodle 1.9 if looged user is admin (not teacher of some courses)
  - added some basic info into global $USER for get_my_courses in Moodle 1.9
1.5.15
  - added get_sections operation
1.5.16
  - testing for moodle 1.9 in server constructor (attrib. $using19) and using it in validate_client to fill global USER
     (required for get_my_courses API call)
  -  fix a notice (DEBUG already defined)
  - fix a notice error undefined in filter_section and filter_resource
*/
require_once ('../config.php');
require_once ('atilib.php');
/// increase memory limit (PHP 5.2 does different calculation, we need more memory now)
// j'ai 11000 comptes
@ raise_memory_limit("192M"); //fonction de lib/setuplib.php incluse via config.php
set_time_limit(0);
//define('DEBUG', true);  rev. 1.5.16 already set (or not) in  MoodleWS.php
define('cal_show_global', 1);
define('cal_show_course', 2);
define('cal_show_groups', 4);
define('cal_show_user', 8);
/**
 * The main server class.
 *
 * This class is broken up into three main sections of methods:
 * 1. Methods that perform actions related to client requests.
 * 2. Methods that handle server setup, incoming client requests, and returning a
 *    response to the client.
 * 3. Utility functions that perform functions such as datetime format conversion or
 *    replication of Moodle library functions in a manner safe for usage within this
 *    web services implementatation.
 *
 * The only methods that need to be extended in a child class are main() and any of
 * the service methods which need special transport-protocol specific handling of
 * input and / or output data.
 *
 *
 * @package Web Services
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca>
 */
class server {
	var $version = 2007051000; // added ip in mdl_webservice_sessions
	var $sessiontimeout = 1800; // 30 minutes.
	var $using17;
	var $using19 = false;
	/**
	 * Constructor method.
	 *
	 * @uses $CFG
	 * @param none
	 * @return none
	 */
	function server() {
		global $CFG;
		$this->debug_output("Server init...");
		$this->using17 = file_exists($CFG->libdir . '/accesslib.php');
		$this->using19 = file_exists($CFG->libdir . '/grouplib.php');
		/// Check for any upgrades.
		if (empty ($CFG->webservices_version)) {
			$this->upgrade(0);
		} else
			if ($CFG->webservices_version < $this->version) {
				$this->upgrade($CFG->webservices_version);
			}
        if (!empty($CFG->ws_sessiontimeout))
            $this->sessiontimeout= $CFG->ws_sessiontimeout;
	}
	/**
	 * Performs an upgrade of the webservices system.
	 *
	 * @uses $CFG
	 * @param int $oldversion The old version number we are upgrading from.
	 * @return boolean True if successful, False otherwise.
	 */
	function upgrade($oldversion) {
		global $CFG;
		$this->debug_output('Starting WS upgrade to version ' . $oldversion);
		ob_start();
		$return = true;
		if ($this->using17) {
			require_once ($CFG->libdir . '/ddllib.php');
			if ($oldversion < 2006050800) {
				// oups . until v 1.5.4 dbdir was still /ws/db/install.xml and db/ was not distributed !!!
				$return = install_from_xmldb_file($CFG->dirroot . '/wspp/db/install.xml');
			} else {
				// add ip column if $oldversion < 2007051000;
				$table = new XMLDBTable('webservices_sessions');
				$field = new XMLDBField('ip');
				// since table exists, keep NULL as true and no default value !
				// otherwise XMLDB do not do the change but return true ...
				$field->setAttributes(XMLDB_TYPE_CHAR, '64');
				$return = add_field($table, $field, false, false);
			}
		} else {
			//TODO upgrade 1.5-> 1.5.4 for Moodle <1.7 to add only the ip column  HOW ?
			if ($oldversion < 2006050800) {
				if ($CFG->dbtype == 'mysql') {
					if ($return) {
						$return = modify_database('', "
						                                CREATE TABLE `prefix_webservices_clients_allow` (
						                                    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
						                                    `client` VARCHAR(15) NOT NULL DEFAULT '0.0.0.0',
						                                    PRIMARY KEY `id` (`id`)
						                                );
						                            ");
					}
					if ($return) {
						$return = modify_database('', "
						                                CREATE TABLE `prefix_webservices_sessions` (
						                                    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
						                                    `sessionbegin` INT(10) UNSIGNED NOT NULL DEFAULT 0,
						                                    `sessionend` INT(10) UNSIGNED NOT NULL DEFAULT 0,
						                                    `sessionkey` VARCHAR(32) NOT NULL DEFAULT '',
						                                    `userid` INT(10) UNSIGNED NOT NULL DEFAULT 0,
						                                    `verified` TINYINT(1) NOT NULL DEFAULT 0,
						                                    `ip` VARCHAR(64) NOT NULL DEFAULT '',
						                                    PRIMARY KEY `id` (`id`)
						                                );
						                            ");
					}
				} else
					if ($CFG->dbtype == 'postgres7') {
						if ($return) {
							$return = modify_database('', "
							                                CREATE TABLE prefix_webservices_clients_allow (
							                                    id SERIAL PRIMARY KEY,
							                                    client VARCHAR(15) NOT NULL DEFAULT '0.0.0.0'
							                                );
							                            ");
						}
						if ($return) {
							$return = modify_database('', "
							                                CREATE TABLE prefix_webservices_sessions (
							                                    id SERIAL PRIMARY KEY,
							                                    sessionbegin INTEGER NOT NULL DEFAULT 0,
							                                    sessionend INTEGER NOT NULL DEFAULT 0,
							                                    sessionkey VARCHAR(32) NOT NULL DEFAULT '',
							                                    userid INTEGER NOT NULL DEFAULT 0,
							                                    verified INTEGER NOT NULL DEFAULT 0
							                                );
							                            ");
						}
					}
			}
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$this->debug_output('Database output: ' . trim(ob_get_clean()));
		}
		if ($return) {
			set_config('webservices_version', $this->version);
			$this->debug_output('Upgraded from ' . $oldversion . ' to ' . $this->version);
		} else {
			$this->debug_output('ERROR: Could not upgrade to version ' . $this->version);
		}
		ob_end_clean();
		return $return;
	}
	/**
	 * Initializes a connection to a new client by generating a random session
	 * key to be used for communications with this specific client.
	 *
	 * @param int $client The client session record ID.
	 * @return object A new request object containing information the client
	 *                needs for further communication or an error object.
	 */
	function init($client) {
		$this->debug_output('Running INIT for client: ' . $client);
		/// Add this client's database record.
		if (!$sess = get_record('webservices_sessions', 'id', $client)) {
		     $this->debug_output('No session');
			return $this->error('Could not get validated client session (' . $client . ').');
		}
		$sess->sessionbegin = time();
		$sess->sessionend = 0;
		$sess->sessionkey = $this->add_session_key();
		if (!update_record('webservices_sessions', $sess)) {
				$this->debug_output('No update');
			return $this->error('Could not initialize client session (' . $client . ').');
		}

		$this->debug_output('Login successful.');

		/// Return standard data to be converted into the appropriate data format
		/// for return to the client.
		$ret = array (
			'client' => $client,
			'sessionkey' => $sess->sessionkey
		);
		$this->debug_output(print_r($ret, true));
		return $ret;
	}
	/**
	 * Creates a new session key.
	 *
	 * @param none
	 * @return string A 32 character session key.
	 */
	function add_session_key() {
		$time = (string) time();
		$randstr = (string) random_string(10);
		/// XOR the current time and a random string.
		$str = $time;
		$str ^= $randstr;
		/// Use the MD5 sum of this random 10 character string as the session key.
		return md5($str);
	}
	/**
	 * Gets the session key from the database for a particular client.
	 *
	 * @param int $client The client session record ID.
	 * @return string|boolean The client's current session key or False.
	 */
	function get_session_key($client) {
		if (!$sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
				$this->debug_output('No session exists for client: ' . $client);
			 return false;
		}
		return $sess->sessionkey;
	}

	/**

	 * Get the userid from the database for a particular client's session.
	 *
	 * @param int $client the client session record ID.
	 * @return int|boolean The client's current userid or False.
	 */
	function get_session_user($client) {
		if (!$sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
				$this->debug_output('No session exists for client: ' . $client);
			return false;
		}
		return $sess->userid;
	}
	/**
	 * Validate's that a client has an existing session.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @return boolean True if the client is valid, False otherwise.
	 */
	function validate_client($client = 0, $sesskey = '',$operation='') {
		global $USER, $CFG;
		/// We can't validate a session that hasn't even been initialized yet.
		if (!$sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
			return false;
		}
		/// Validate this session.
		if ($sesskey != $sess->sessionkey) {
			return false;
		}

        // rev 1.6 make sure the session has not timed out
         // rev 843 pas trop longtemps sans logout ...
        if ($sess->sessionbegin + $this->sessiontimeout < time()){
            $sess->sessionend=time();
            update_record('webservices_sessions', $sess,'id');
            return false;
        }

		// rev 1.5.14 otherwise get_my_courses does not show hidden courses in 1.9 !
		// bug breaks everything in Moodle 1.7 ($this->isadmin fails !)
		if ($this->using19) {
			$USER->id = $sess->userid;
			$USER->username = '';
			$USER->mnethostid = $CFG->mnet_localhost_id; //Moodle 1.95+ build sept 2009
			unset ($USER->access); // important for get_my_courses !
			$this->debug_output("validate_client OK $client user=" . print_r($USER, true));
		}

        //LOG INTO MOODLE'S LOG
        add_to_log(SITEID,'webservice pp','',$operation);
		return true;
	}

	/**
	 * Validates a client's login request.
	 *
	 * @uses $CFG
	 * @param array $input Input data from the client request object.
	 * @return array Return data (client record ID and session key) to be
	 *               converted into a specific data format for sending to the
	 *               client.
	 */
	function login($username, $password) {
		global $CFG;

        if (!empty($CFG->ws_disable))
            return $this->error ("web service access disabled on this site");
		/// Use Moodle authentication.
		/// FIRST make sure user exists , otherwise account WILL be created with CAS authentification ....
		if (!$knowuser = get_record('user', 'username', $username)) {
			return $this->error('Invalid username and / or password.');
		}
		/// also make sure internal_authentication is used  (a limitation to fix ...)
		if (!is_internal_auth($knowuser->auth)) {
			return $this->error('Invalid username and / or password.');
		}
		$user = authenticate_user_login($username, $password);
		// $this->debug_output('return of a_u_l'. print_r($user,true));
		if (($user === false) || ($user && $user->id == 0)) {
			return $this->error('Invalid username and / or password.');
		} else {
			/// Verify that an active session does not already exist for this user.
			$sql = "SELECT s.*
			                        FROM {$CFG->prefix}webservices_sessions s
			                        WHERE s.userid = {$user->id} AND
			                              s.verified = 1 AND
			                              s.sessionend != 0 AND
			                              (" . time() . " - s.sessionbegin) < " . $this->sessiontimeout;
			if (record_exists_sql($sql)) {
                   //return $this->error('A session already exists for this user (' . $user->login . ')');
            return $this->init($sess->id) ; // V1.6 reuse current session
			}
			/// Login valid, create a new session record for this client.
			$sess = new stdClass;
			$sess->userid = $user->id;
			$sess->verified = true;
			$sess->ip = getremoteaddr(); // rev 1.5.4
			$sess->id = insert_record('webservices_sessions', $sess);
             add_to_log(SITEID,'webservice pp','',$login);
			return $this->init($sess->id);
		}
	}
	/**
	 * Logs a client out of the system by removing the valid flag from their
	 * session record and any user ID that is assosciated with their particular
	 * session.
	 *
	 * @param integer $client The client record ID.
	 * @param string $sesskey The client session key.
	 * @return boolean True if successfully logged out, false otherwise.
	 */
	function logout($client, $sesskey) {
		if (!$this->validate_client($client, $sesskey)) {
			return $this->error('Invalid client connection.');
		}
		if ($sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
			// $sess->userid   = 0;  why ? we should keep track of who came to see us ?
			$sess->verified = 0;
			if (update_record('webservices_sessions', $sess)) {
                 add_to_log(SITEID,'webservice pp','',$logout);
				return $this->client_disconnect($client);
			} else {
				return false;
			}
		}
		return false;
	}
	/**
	 * Closes a client's session on the system.
	 *
	 * @param int $client The client session record ID.
	 * @return boolean True on success, False otherwise.
	 */
	function client_disconnect($client) {
		if ($sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 0)) {
			$sess->sessionend = time();
			if (!update_record('webservices_sessions', $sess)) {
				return false;
			} else {
				return true;
			}
		}
		return false;
	}
	/**
	 * Edit user records (add/update/delete).
	 * FIXED in rev 1.5.8
	 * @uses $CFG
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $users An array of user records (objects or arrays) for editing
	 *                     (including opertaion to perform).
	 * @return array Return data (user record) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function edit_users($client, $sesskey, $users) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'edit_users')) {
			return $this->error('Invalid client connection.');
		}
		/// Verify that the user for this session can perform this operation.
		$uid = $this->get_session_user($client);
		if (!$this->isadmin($uid)) {
			return $this->error('You do not have proper access to perform this operation.');
		}
		$rusers = array ();

			$this->debug_output('Attempting to update user IDS: ' . print_r($users, true));
		if (!empty ($users)) {
			foreach ($users->users as $user) {
				$ruser = new stdClass;

					$this->debug_output('traitement de ' . print_r($user, true));
				//obs by Lille: add md5 to the password
				// todo test wherher it is needed or not ?
				$user->password = md5($user->password);
				switch ($user->action) {
					case 'Add' :
						$useradd = $user;
						unset ($useradd->action);

							$this->debug_output('adding' . print_r($useradd, true));
						//Moodle 1.8 and later (a required field that must be non 0 for login )
						if (!empty ($CFG->mnet_localhost_id))
							if (!$useradd->mnethostid) //if not set by caller (TODO add to userdatum record)
								$useradd->mnethostid = $CFG->mnet_localhost_id; // always local user
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						// Lille : verify if current user is already in database
						if ($userExist = get_record("user", "username", $user->username)) {
							$ruser = $userExist;
							$ruser->error = "user $user->username  already exists";
							break;
						}
						// end Lille
						ob_start();
						if (!isset ($useradd->confirmed) || empty ($useradd->confirmed)) {
							$useradd->confirmed = true;
						}
						$useradd->id = insert_record('user', $useradd);

							$this->debug_output('ID is ' . $useradd->id);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							return $this->error('Database error: ' . $msg);
						}
						ob_end_clean();
						if (empty ($useradd->id)) {
							$ruser->error = 'Could not add user: ' . fullname($useradd);
						} else {
							$ruser = get_record('user', 'id', $useradd->id);
						}
						break;
					case 'Update' :
						$userup = $user;
						$uid = $userup->idnumber;
						$dbfail = false;
						unset ($userup->action);

							$this->debug_output('Attempting to update user ID: ' . $uid);
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						$user = get_record('user', 'idnumber', $userup->idnumber);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$ruser = $user;
							$ruser->error = 'Database error: ' . $msg;
							$dbfail = true;
						}
						ob_end_clean();
						if (!$dbfail && empty ($user)) {
							$ruser = $user;
							$ruser->error = 'Could not find user ID: ' . $uid;
						} else {
							/// Update values in the $user database record with what
							/// the client supplied.
							foreach ($userup as $key => $value)
								if (!empty ($value)) // rev 1.5.15 must ignore empty values ! serious flaw !
									$user-> $key = $value;
							$user->timemodified = time();
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.
							ob_start();
							$success = update_record('user', $user);
							if (ob_get_length() && trim(ob_get_contents())) {
								/// Return an error with  the contents of the output buffer.
								$msg = trim(ob_get_clean());
								$ruser = $user;
								$ruser->error = 'Database error: ' . $msg;
								$dbfail = true;
							}
							ob_end_clean();
							if (!$dbfail && !$success) {
								$ruser = $user;
								$ruser->error = 'Could not update user: ' . $uid;
							} else
								if (!$dbfail && $success) {
									$ruser = get_record('user', 'id', $user->id);
								}
						}
						break;
					case 'Delete' :
						$uid = $user->idnumber;
						$dbfail = false;
						/// Deleting an existing user.

							$this->debug_output('Attempting to delete user ID: ' . $uid);
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						$user = get_record('user', 'idnumber', $uid);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$ruser->error = 'Database error: ' . $msg;
							$dbfail = true;
						}
						ob_end_clean();
						if (!$dbfail && empty ($user)) {
							$ruser->error = 'Could not find user ID: ' . $uid;
						} else {
							/// 'Delete' the user the Moodle way.
							$updateuser = new stdClass;
							$updateuser->id = $user->id;
							$updateuser->deleted = "1";
							$updateuser->username = "$user->email." . time(); // Remember it just in case
							$updateuser->email = ""; // Clear this field to free it up
							$updateuser->idnumber = ""; // Clear this field to free it up
							$updateuser->timemodified = time();
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.
							ob_start();
							$success = update_record('user', $updateuser);
							if (ob_get_length() && trim(ob_get_contents())) {
								/// Return an error with  the contents of the output buffer.
								$msg = trim(ob_get_clean());
								$ruser->error = 'Database error.' . $msg;
								$dbfail = true;
							}
							ob_end_clean();
							if (!$dbfail && $success) {
								if ($this->using17) {
									delete_records('role_assignments', 'userid', $user->id);
								} else {
									unenrol_student($user->id); // From all courses
									remove_teacher($user->id); // From all courses
									remove_admin($user->id);
								}
								$ruser = get_record('user', 'id', $user->id);
							} else
								if ($dbfail || !$success) {
									$ruser = $user;
									$ruser->error = 'Could not delete user ID: ' . $uid;
								}
						}
						break;
					case 'Undelete' : //ATI added  operation
						$userup = $user;
						$uid = $userup->idnumber;
						$dbfail = false;
						unset ($userup->action);

							$this->debug_output('Attempting to update user ID: ' . $uid);
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						$user = get_record('user', 'firstname', $userup->idnumber);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$ruser = $user;
							$ruser->error = 'Database error: ' . $msg;
							$dbfail = true;
						}
						ob_end_clean();
						if (!$dbfail && empty ($user)) {
							$ruser = $user;
							$ruser->error = 'Could not find user ID: ' . $uid;
						} else {
							/// Update values in the $user database record with what
							/// the client supplied.
							foreach ($userup as $key => $value)
								$user-> $key = $value;
							$user->timemodified = time();
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.
							ob_start();
							$success = update_record('user', $user);
							if (ob_get_length() && trim(ob_get_contents())) {
								/// Return an error with  the contents of the output buffer.
								$msg = trim(ob_get_clean());
								$ruser = $user;
								$ruser->error = 'Database error: ' . $msg;
								$dbfail = true;
							}
							ob_end_clean();
							if (!$dbfail && !$success) {
								$ruser = $user;
								$ruser->error = 'Could not update user: ' . $uid;
							} else
								if (!$dbfail && $success) {
									$ruser = get_record('user', 'id', $user->id);
								}
						}
						break;
				}
				$rusers[] = $ruser;
			}
		}
		return $rusers;
	}
	/**
	 * Find and return a list of user records.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $userids An array of input user idnumber values. If empty, return all users
	 * @param string $idfield The field used to compare the user ID fields against.
	 * @return array Return data (user record) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function get_users($client, $sesskey, $userids, $idfield = 'idnumber') {
		if (!$this->validate_client($client, $sesskey,'get_users')) {
			return $this->error('Invalid client connection.');
		}
		/// Verify that the user for this session can perform this operation.
		$uid = $this->get_session_user($client);
		if (!$this->isteacherinanycourse($uid)) {
			return $this->error('You do not have proper access to perform this operation.');
		}
		$ret = array (); // Return array.
		if (empty ($userids)) { // all users ...
			return $this->filter_users($client, get_users(true), 0);
		}
		foreach ($userids as $userid) {
			$error = '';
			/// This database operation MIGHT throw an HTML error message,
			/// so we've got to catch that and send it back in an error
			/// request.
			ob_start();
			$users = get_records('user', $idfield, $userid);
			if (ob_get_length() && trim(ob_get_contents())) {
				/// Return an error with  the contents of the output buffer.
				$msg = trim(ob_get_clean());
				$error = 'Database error: ' . $msg;
			}
			ob_end_clean();
			if (!empty ($error)) {
				$this->debug_output(' DB error' . $msg);
				return $this->error($error);
			}
			if (empty ($users)) {
				$ret[] = $this->non_fatal_error("no match found for $idfield= $userid");
			} else {
				$users = $this->filter_users($client, $users, 0);
				foreach ($users as $user)
					$ret[] = $user;
			}
		}
		return $ret;
	}
	/**
	 * Edit course records (add/update/delete).
	 * TESTED and fixed in rev 1.5.8 PP
	 * @uses $CFG
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $courses An array of course records (objects or arrays) for editing
	 *                       (including opertaion to perform).
	 * @return array Return data (course record) to be converted into a specific
	 *               data format for sending to the client.
	 */
	function edit_courses($client, $sesskey, $courses) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'edit_courses')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		$site = get_site();
		$ret = array ();
		if (!empty ($courses)) {
			foreach ($courses->courses as $course) {
				$rcourse = new stdClass;
				switch ($course->action) {
					case 'Add' :
						/// Adding a new course.
						$courseadd = $course;

							$this->debug_output('Trying to add a new course.');
						/// Check for correct permissions.
						if (!$this->iscreator($uid)) {

								$this->debug_output('Invalid access UID: ' . $uid);
							$rcourse->error = 'You do not have proper access to perform this operation.';
						} else
							if (record_exists('course', 'idnumber', $courseadd->idnumber)) {
								$rcourse->error = 'A course with this ID number already exists: ' .								$courseadd->idnumber;
							} else {
								/// These database operations MIGHT throw an HTML error message,
								/// so we've got to catch that and send it back in an error
								/// request.
								//verify if current course is aleready in db
								//Lille
								$this->debug_output("ajunge ACI");
								if ($courseExist = get_record("course", "shortname", $course->shortname)) {
									$rcourse = $courseExist;
									$rcourse->error = "course shortname $course->shortname already used";
									break;
								}
								//TODO collect Admin default settings  (see course/pending)
								ob_start();
								// place at beginning of category
								fix_course_sortorder();
								$courseadd->sortorder = get_field_sql("SELECT min(sortorder)-1 FROM " .								"{$CFG->prefix}course WHERE category=$courseadd->category");
								if (empty ($courseadd->sortorder)) {
									$courseadd->sortorder = 100;
								}
								if (!isset ($courseadd->maxbytes)) {
									$byteschoices = get_max_upload_sizes($CFG->maxbytes);
									$courseadd->maxbytes = key($byteschoices);
								}
								if (!isset ($courseadd->startdate)) {
									$courseadd->startdate = time();
								}
								$courseadd->timecreated = time();
								$courseadd->timemodified = time();
								//make sure a category is specified - default moodle category is implicit
								if (!isset ($courseadd->category) || $courseadd->category == 0) {
									$courseadd->category = 1;
								}
								$courseadd->id = insert_record('course', $courseadd);
								if (ob_get_length() && trim(ob_get_contents())) {
									/// Return an error with  the contents of the output buffer.
									$msg = trim(ob_get_contents());
									$rcourse->error = 'Database error: ' . $msg;
								}
								ob_end_clean();
								if (empty ($courseadd->id)) {
									$rcourse->error = 'Could not add course: ' .									$courseadd->shortname;
								} else {
									require_once ($CFG->libdir . '/pagelib.php');
									require_once ($CFG->libdir . '/blocklib.php');
									/// These API calls MIGHT throw an HTML error message,
									/// so we've got to catch that and send it back in an error
									/// request.
									ob_start();
									/// Setup page blocks.
									$page = page_create_object(PAGE_COURSE_VIEW, $courseadd->id);
									blocks_repopulate_page($page);
									if (ob_get_length() && trim(ob_get_contents())) {
										$msg = trim(ob_get_clean());
										$rcourse->error = 'API call error: ' . $msg;
									}
									/// Create a default section.
									$section = NULL;
									$section->course = $courseadd->id;
									$section->section = 0;
									$section->id = insert_record('course_sections', $section);
									if (ob_get_length() && trim(ob_get_contents())) {
										$msg = trim(ob_get_clean());
										$rcourse->error = 'Database error: ' . $msg;
									}
									ob_end_clean();
									$rcourse = get_record('course', 'id', $courseadd->id);
								}
							}
						break;
					case 'Update' :
						/// Updating an existing course.
						$courseup = $course;
						$cid = $courseup->idnumber;
						$dbfail = false;

							$this->debug_output('Attempting to update course ID: ' . $cid . print_r($course, true));
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						$course = get_record('course', 'idnumber', $cid);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.

								$this->debug_output('E_DB: "' . ob_get_contents() . '"');
							$msg = trim(ob_get_clean());
							$rcourse->error = 'Database error: ' . $msg;
							$dbfail = true;
						}
						ob_end_clean();
						/// Check for correct permissions.
						if (!$dbfail && empty ($course)) {
							$rcourse->error = 'Could not find course ID: ' . $cid;
						} else
							if (!$dbfail && !$this->isteacher($course->id, $uid)) {
								$rcourse->error = 'You do not have proper access to perform this operation.';
							} else
								if (!$dbfail) {
									/// Update values in the course database record with what
									/// the client supplied.
									foreach ($courseup as $key => $value)
										if (!empty ($value)) // rev 1.5.15 must ignore empty values ! serious flaw !
											$course-> $key = $value;
									$course->timemodified = time();
									ob_start();
									$success = update_record('course', $course);
									if (ob_get_length() && trim(ob_get_contents())) {
										$msg = trim(ob_get_clean());
										$rcourse->error = 'Database error: ' . $msg;
										$dbfail = true;
									}
									ob_end_clean();
									if (!$dbfail && !$success) {
										$rcourse->error = 'Could not update course: ' . $cid;
									} else
										if (!$dbfail && $success) {
											$rcourse = get_record('course', 'id', $course->id);
										}
								}
						break;
					case 'Delete' :
						/// Deleting an existing course.
						$cid = $course->idnumber;
						$dbfail = false;
						/// Check for correct permissions.
						if (!$this->isadmin($uid)) {
							$rcourse->error = 'You do not have proper access to ' .							'perform this operation.';
						} else {

								$this->debug_output('Attempting to delete course ID: ' . $cid);
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.
							ob_start();
							$course = get_record('course', 'idnumber', $cid);
							if (ob_get_length() && trim(ob_get_contents())) {
								/// Return an error with  the contents of the output buffer.
								$msg = trim(ob_get_clean());
								$rcourse->error = 'Database error: ' . $msg;
								$dbfail = true;
							}
							ob_end_clean();
							if (!$dbfail && empty ($course)) {
								$rcourse->error = 'Could not find course ID: ' . $cid;
							} else
								if (!$dbfail) {
									/// 'Delete' the course the Moodle way.
									$success_r = true;
									$success_d = true;
									$success_f = true;
									/// These operations MIGHT throw an HTML error message,
									/// so we've got to catch that and send it back in an error
									/// request.
									ob_start();
									require_once ($CFG->libdir . '/moodlelib.php');
									$success_r = remove_course_contents($course->id, false);
									if (ob_get_length() && trim(ob_get_contents())) {
										/// Return an error with  the contents of the output buffer.
										$msg = trim(ob_get_clean());
										$rcourse->error = 'API call error: ' . $msg;
									}
									if ($success_r && !isset ($rcourse->error)) {
										$success_d = delete_records('course', 'id', $course->id);
									}
									if (ob_get_length() && trim(ob_get_contents())) {
										/// Return an error with a E_DB status set and the
										/// contents of the output buffer.
										$msg = trim(ob_get_clean());
										$rcourse->error('Database error.', WS_STAT_E_DB, $msg);
									}
									if ($success_r && $success_d && !isset ($rcourse->error) && ($dir = @ opendir($CFG->dataroot . '/' . $course->id))) {
										closedir($dir);
										require_once ($CFG->libdir . '/filelib.php');
										$success_f = fulldelete($CFG->dataroot . '/' . $course->id);
									}
									if (ob_get_length() && trim(ob_get_contents())) {
										/// Return an error with  the contents of the output buffer.
										$msg = trim(ob_get_clean());
										return $this->error('API call error (2).', WS_STAT_E_API, $msg);
									}
									ob_end_clean();
									if (!isset ($rcourse->error)) {
										if (!$success_r) {
											$rcourse->error = 'Error deleting some of the course contents (' .											$cid . ').';
										} else
											if (!$success_d) {
												$rcourse->error = 'Error deleting the course record (' . $cid . ').';
											} else
												if (!$success_f) {
													$rcourse->error = 'Error deleting the course data (' . $cid . ').';
												} else {
													$rcourse = $course;
												}
									}
								}
						}
						break;
				}
				$ret[] = $rcourse;
			}
		}
		return $ret;
	}
	/**
	 * Find and return a list of course records.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $courseids An array of input course values to search for.If empty, all courses
	 * @param string $idfield  searched column . May be any column of table mdl_course
	 * @return array Return data (course record) to be converted into a specific
	 *               data format for sending to the client.
	 */
	function get_courses($client, $sesskey, $courseids, $idfield = 'idnumber') {
		if (!$this->validate_client($client, $sesskey,'get_courses')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		$ret = array ();
		if (empty ($courseids)) {
			// all courses wanted
			//we cannot use datalib/get_courses that filter off courses against $USER
			// that is not (yet) set here
			$res = get_records('course', '', '');
			return $this->filter_courses($client, $res);
		}
		foreach ($courseids as $courseid) {
			/// This database operation MIGHT throw an HTML error message,
			/// so we've got to catch that and send it back in an error
			/// request.
			ob_start();
			$courses = get_records('course', $idfield, $courseid);
			if (ob_get_length() && trim(ob_get_contents())) {
				/// Return an error with  the contents of the output buffer.
				$msg = trim(ob_get_clean());
				$ret[] = $this->error('Database error: ' . $msg);
			}
			ob_end_clean();
			if (!empty ($courses)) {
				$courses = $this->filter_courses($client, $courses);
				foreach ($courses as $course)
					$ret[] = $course;
			} else {
				$ret[] = $this->non_fatal_error("no match for $idfield = $courseid");
			}
		}
		return $ret;
	}
	/**
	* Find and return a list of resources within one or several courses.
	* OK PP tested with php5 5 and python clients
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $courseids An array of input course id values to search for. If empty return all ressources
	* @param string $idfield : the field used to identify courses
	* @return array An array of course records.
	*/
	public function get_resources($client, $sesskey, $courseids, $idfield = 'idnumber') {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'get_resources')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		$ret = array ();
		if (empty ($courseids)) {
			// all resources from all courses wanted
			//we cannot use datalib/get_courses that filter off courses against $USER
			// that is not (yet) set here
			$courses = get_records('course', '', '');
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$tmp->error = 'Could not find course with ' . $idfield . '=' . $courseid;
					$ret[] = $tmp;
				}
			}
		}
		//remove courses not available to current user
		$courses = $this->filter_courses($client, $courses);
		$ilink = "{$CFG->wwwroot}/mod/resource/view.php?id=";
		foreach ($courses as $course) {
			if ($resources = get_all_instances_in_course("resource", $course, NULL, true)) {
				foreach ($resources as $resource) {
					$resource->url = $ilink . $resource->coursemodule;
					$ret[] = $resource;
				}
			}
		}
		return $this->filter_resources($client, $ret);
	}
	/**
	    * Find and return a list of sections within one or several courses.
	    * OK PP tested with php5 5 and python clients
	    * @param int $client The client session ID.
	    * @param string $sesskey The client session key.
	    * @param array $courseids An array of input course id values to search for. If empty return all sections
	    * @param string $idfield : the field used to identify courses
	    * @return array An array of course records.
	    */
	public function get_sections($client, $sesskey, $courseids, $idfield = 'idnumber') {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'get_sections')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		$ret = array ();
		$this->debug_output('get_sections ' . print_r($courseids, true));
		if (!empty ($courseids) && !is_array($courseids)) {
			$courseids = array (
				$courseids
			);
		}
		$this->debug_output('get_sections II' . print_r($courseids, true));
		if (empty ($courseids)) {
			// all resources from all courses wanted
			//we cannot use datalib/get_courses that filter off courses against $USER
			// that is not (yet) set here
			$courses = get_records('course', '', '');
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$tmp->error = 'Could not find course with ' . $idfield . '=' . $courseid;
					$ret[] = $tmp;
				}
			}
		}
		//remove courses not available to current user
		$courses = $this->filter_courses($client, $courses);
		foreach ($courses as $course) {
			if ($resources = get_all_sections($course->id))
				foreach ($resources as $resource) {
					$ret[] = $resource;
				}
		}
		return $this->filter_sections($client, $ret);
	}
	public function get_instances_bytype($client, $sesskey, $courseids, $idfield = 'idnumber', $type) {
		//TODO merge with get_resources by giving $type="resource"
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'get_instances_bytype')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		$ret = array ();
		if (empty ($courseids)) {
			// all resources from all courses wanted
			//we cannot use datalib/get_courses that filter off courses against $USER
			// that is not (yet) set here
			$courses = get_records('course', '', '');
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$tmp->error = 'Could not find course with ' . $idfield . '=' . $courseid;
					$ret[] = $tmp;
				}
			}
		}
		//remove courses not available to current user
		$courses = $this->filter_courses($client, $courses);
		foreach ($courses as $course) {
			$resources = get_all_instances_in_course($type, $course, NULL, true);
			$ilink = "{$CFG->wwwroot}/mod/$type/view.php?id=";
			foreach ($resources as $resource) {
				$resource->url = $ilink . $resource->coursemodule;
				$ret[] = $resource;
			}
		}
		return $this->filter_resources($client, $ret);
	}
	/**
	     * Find and return student grades for currently enrolled courses  Function for Moodle 1.9)
	     *
	     * @uses $CFG
	     * @param int $client The client session ID.
	     * @param string $sesskey The client session key.
	     * @param string $userid The ATIStudentID number of the student.
	     * @param string $courseids Array of short courses
	     * @param string $idfield
	     * @return userGrade [] $returna The student grades
	     *
	*/
	function get_grades($client, $sesskey, $userid, $courseids, $idfield = 'idnumber') {
		global $CFG;
		require_once ($CFG->dirroot . '/grade/lib.php');
		require_once ($CFG->dirroot . '/grade/querylib.php');
		if (!$this->validate_client($client, $sesskey,'get_grades')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);
		if (!$user = get_record('user', 'idnumber', $userid)) {
			return $this->error('Could not find user record (' . $userid . ').');
		}
		$return = array ();
		/// Find grade data for the requested IDs.
		foreach ($courseids as $cid) {
			$rgrade = new stdClass;
			/// Get the student grades for each course requested.
			if ($course = get_record('course', $idfield, $cid)) {
				if ($this->isteacher($course->id, $uid)) {
					//  get the floating point final grade
					if ($legrade = grade_get_course_grade($user->id, $course->id)) {
                        $rgrade=$legrade;
                        $rgrade->error = '';
                        $rgrade->itemid = $cid;
					} else {
						$rgrade->error = 'No grade data for student ' . fullname($user) .						' in course ' . $course->fullname;
					}
				} else {
					$rgrade->error = ' not a teacher of course ' . $course->fullname;
				}
			} else {
				$rgrade->error = 'Could not find course ' . $cid;
			}
			$return[] = $rgrade;
		}
        //$this->debug_output("GG".print_r($return, true));
		return $this->filter_grades($client,$return);
	}


	public function get_user_grades($client, $sesskey, $userid,$idfield="idnumber") {

		if (!$user = get_record('user', 'idnumber', $userid)) {
			return $this->error('Could not find user record (' . $userid . ').');
		}

		// we cannot call  API grade_get_course_grade($user->id) since it does not set the courseid as we want it

		if (!$courses = get_my_courses($user->id, $sort='visible DESC,sortorder ASC', $fields='idnumber')) {
			return $this->error('Could not find any grades for user ' . $userid );
		}
		$courseids=array();
		foreach ($courses as $c)
		      if (!empty($c->idnumber)) $courseids[]=$c->idnumber;
		$this->debug_output("GUG=".print_r($courseids,true));
        // caution not $this->get_user_grades THAT WILL call mdl_sopaserver::get_grades
        // resulting in two calls of to_soaparray !!!!
		return server::get_grades($client,$sesskey,$userid,$courseids,'idnumber');
	}

	public function get_course_grades($client, $sesskey, $courseid,$idfield="idnumber") {
		global $CFG;
		require_once ($CFG->dirroot . '/grade/lib.php');
		require_once ($CFG->dirroot . '/grade/querylib.php');
		if (!$this->validate_client($client, $sesskey,'get_course_grades')) {
			return $this->error('Invalid client connection.');
		}
		$uid = $this->get_session_user($client);


		$return =array();
		//Get all student grades for course requested.
		if ($course = get_record('course', $idfield, $courseid)) {
			if ($this->isteacher($course->id, $uid)) {
				$students=array();
                $context = get_context_instance(CONTEXT_COURSE, $course->id);

               $students = get_role_users(5, $context, true,'');
               //$this->debug_output("GcG".print_r($students, true));
				foreach ($students as $user) {
					if ($legrade = grade_get_course_grade($user->id, $course->id)) {
                        $rgrade = $legrade;
                        $rgrade->error = '';
                        $rgrade->itemid=$user->idnumber;
						//  $this->debug_output("IDS=".print_r($legrade,true));
						$return[] = $rgrade;
					} else {
						$rgrade->error = 'No grade data for student ' . fullname($user);
					}
				}
			} else {
				$rgrade->error = ' not a teacher of course ' . $course->fullname;
				$return[] = $rgrade;
			}
		} else {
			$rgrade->error = 'Could not find course ' . $cid;
			$return[] = $rgrade;
		}
             $this->debug_output("GcG".print_r($return, true));

		return $this->filter_grades($client,$return);

	}


	/**
	 * Enrol users as a student in the given course.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param string $courseid The course ID number to enrol students in.
	 * @param array $userids An array of input user idnumber values for enrolment.
	 * @param string $idfield identifier used for users . Note that $courseid is expected
	 *    to contains an idnumber and not Moodle id.
	 * @return array Return data (user_student records) to be converted into a
	 *               specific data format for sending to the client.
	 */
	/******************************************* OLD VERSION
	      function enrol_students($client, $sesskey, $courseid, $userids, $idfield = 'idnumber') {
	          if (!$this->validate_client($client, $sesskey)) {
	              return $this->error('Invalid client connection.');
	          }

	          $uid = $this->get_session_user($client);
	          // note that course is always identified by idnumber, not Moodle's id ...(TODO ?)
	          if (!$course = get_record('course', 'idnumber', $courseid)) {
	              return $this->error('Could not find course record (' . $courseid . ')');
	          }
		    if (! $this->isteacheredit($course->id,$uid))
			return $this->error('You do not have proper access to perform this operation.');
	          $error  = '';
	          $return = new stdClass;

	          if ($course->enrolperiod) {
	              $timestart = time();
	              $timeend   = $timestart + $course->enrolperiod;
	          } else {
	              $timestart = $timeend = 0;
	          }
	           $this->debug_output("IDS=".print_r($userids,true));
	          if (!empty($userids)) {
	              foreach ($userids as $userid) {
	                  if (!$user = get_record('user', $idfield, $userid)) {
	                      $error .= 'Could not find user record (' . $userid. ').' . "\n";
	                  } else {
				//enrol_student is deprecated in moodle 1.7 ...
	                      if (!enrol_student($user->id, $course->id, $timestart, $timeend)) {
	                          $error .= 'Could not enrol user ' . fullname($user) .
	                                    ' in course ' . $course->longname . ".\n";
	                      }  else {
					$st=new studentRecord();
					$st->userid=$user->id;
	               		$st->course=$course->id;
	               		$st->timestart=$timestart;
	               		$st->timeend=$timeend;
					$return->students[]=$st;
				}
	                  }
	              }
	          }
	          else $error='nothing to do';
	          $return->error    = $error;

	          return $return;
	      }
	******************************************************************************************/
	/**
	 * Enrol users as a student in the given category   (ATI Function) (modified)
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param string $courseid The course ID number to enrol students in <- changed to category...
	 * @param array $userids An array of input user idnumber values for enrolment.
	 * @param string $idfield identifier used for users . Note that $courseid is expected
	 *    to contains an idnumber and not Moodle id.
	 * @param string $atigroup group for the student, if 0, then no group is assigned
	 * @param string $enrol operation is enrol or unenrol, default enrol
	 * @return array Return data (user_student records) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function enrol_students($client, $sesskey, $courseid, $userids, $idfield = 'idnumber', $atigroup, $enrol) {
		if (!$this->validate_client($client, $sesskey,'enrol_students')) {
			return $this->error('Invalid client connection.');
		}
		global $CFG;
		require_once ($CFG->libdir . '/atilib.php');
		$role_student = 5; // student (default)
		$groupid = 0; // for the role_assign function (what does this do?)
		$uid = $this->get_session_user($client);
		// first, get the course so we can get its category
		if (!$course = get_record('course', 'idnumber', $courseid)) {
			return $this->error('Could not find course record (' . $courseid . ')');
		}
		// next, from the category, get the category's context
		$context_record = get_context_instance(CONTEXT_COURSECAT, $course->category);
		// then, need the id from the context record
		$context_category = $context_record->id;
		if (!$this->isteacheredit($course->id, $uid))
			return $this->error('You do not have proper access to perform this operation.');
		// for returning info only...
		if ($course->enrolperiod) {
			$timestart = time();
			$timeend = $timestart + $course->enrolperiod;
		} else {
			$timestart = $timeend = 0;
		}

			$this->debug_output("IDS=" . print_r($userids, true));
		$error = "";
		if (!empty ($userids)) {
			foreach ($userids as $userid) {
				if (!$leuser = get_record('user', $idfield, $userid)) {
					$error .= 'Could not find user record (' . $userid . ').' . "\n";
				} else { // else_1
					// finally, enroll the user at the category level of the course
					if ($enrol) {
						if (!role_assign($role_student, $leuser->id, $groupid, $context_category)) {
							$error .= 'Could not enrol user ' . fullname($leuser) .							' in course ' . $course->longname . ".\n";
						} else { // else_2
							if ($atigroup > 0 && $atigroup < 100) {
								// assign into groups
								$lerettf = ati_group_assign($courseid, $userid, $atigroup);
							}
							// build a small studentRecord for return for now ...
							$st = new studentRecord();
							$st->userid = $leuser->id;
							$st->course = $course->id;
							$st->timestart = $timestart;
							$st->timeend = $timeend;
							$return->students[] = $st;
						} // else_2
					} else { //else_3
						if (!role_unassign($role_student, $leuser->id, $groupid, $context_category)) {
							$error .= 'Could not enrol user ' . fullname($leuser) .							' in course ' . $course->longname . ".\n";
						} else { // else_2
							if ($atigroup != 0) {
								// unassign from groups
								$lerettf = ati_group_unassign($courseid, $userid, $atigroup);
							}
							// build a small studentRecord for return for now ...
							$st = new studentRecord();
							$st->userid = $leuser->id;
							$st->course = $course->id;
							$st->timestart = $timestart;
							$st->timeend = $timeend;
							$return->students[] = $st;
						} // else_2
					} //else_3
				} // else_1
			}
		} else
			$error = 'nothing to do';
		$return->error = $error;
		return $return;
	}
	/**
	 * Initializes a new server and calls the dispatch function upon an
	 * incoming client request.
	 *
	 * @todo Override in protocol-specific server subclass.
	 * @param none
	 * @return none
	 */
	function main() {
		/// Override in protocol-specific server subclass.
	}
	/**
	 * Sends an FATAL error response back to the client.
	 *
	 * @todo Override in protocol-specific server subclass, e.g. by throwing a PHP  exception
	 * @param string $msg The error message to return.
	 * @return An object with the error message string.(required by mdl_soapserver)
	 */
	function error($msg) {
		$res = new StdClass();
		$res->error = $msg;

			$this->debug_output("server.soap fatal error : $msg");
		return $res;
	}
	/**
	* return and object with error attribute set
	* this record will be inserted in client array of responses
	* do not override in protocol-specific server subclass.
	*/
	private function non_fatal_error($msg) {
		$res = new StdClass();
		$res->error = $msg;

			$this->debug_output("server.soap non fatal error : $msg");
		return $res;
	}
	/**
	 * Determines if a user an admin
	 *
	 * - Copied from /lib/moodlelib.php & /lib/deprecatedlib.php without using $USER.
	 *
	 * @param int $userid The id of the user as is found in the 'user' table
	 * @return boolean
	 */
	function isadmin($userid) {
		if ($this->using17) {
			return has_capability('moodle/legacy:admin', get_context_instance(CONTEXT_SYSTEM, SITEID), $userid, false);
		} else {
			return record_exists('user_admins', 'userid', $userid);
		}
	}
	/**
	 * Determines if a user is a teacher (or better)
	 *
	 * - Copied from /lib/moodlelib.php & /lib/deprecatedlib.php without using $USER.
	 *
	 * @param int $courseid The id of the course that is being viewed.
	 * @param int $userid The id of the user that is being tested against.
	 * @param boolean $includeadmin If true this function will return true when it encounters an admin user.
	 * @return boolean
	 */
	function isteacher($courseid, $userid, $includeadmin = true) {
		// return false; //test PP
		if ($includeadmin && $this->isadmin($userid)) {
			return true;
		}
		if ($this->using17) {
			return (has_capability('moodle/legacy:teacher', get_context_instance(CONTEXT_COURSE, $courseid), $userid, false) || has_capability('moodle/legacy:editingteacher', get_context_instance(CONTEXT_COURSE, $courseid), $userid, false));
		} else {
			return record_exists('user_teachers', 'userid', $userid, 'course', $courseid);
		}
	}
	/**
	 * Determines if a user is a teacher in any course, or an admin
	 *
	 * - Copied from /lib/moodlelib.php & /lib/deprecatedlib.php without using $USER.
	 *
	 * @param int $userid The id of the user that is being tested against.
	 * @param boolean $includeadmin If true this function will return true when it encounters an admin user.
	 * @return boolean
	 */
	function isteacherinanycourse($userid, $includeadmin = true) {
		if ($includeadmin and $this->isadmin($userid)) { // admins can do anything
			return true;
		}
		if ($this->using17) {
			if (!record_exists('role_assignments', 'userid', $userid)) { // Has no roles anywhere
				return false;
			}
			/// If this user is assigned as an editing teacher anywhere then return true
			if ($roles = get_roles_with_capability('moodle/legacy:editingteacher', CAP_ALLOW)) {
				foreach ($roles as $role) {
					if (record_exists('role_assignments', 'roleid', $role->id, 'userid', $userid)) {
						return true;
					}
				}
			}
			/// If this user is assigned as a non-editing teacher anywhere then return true
			if ($roles = get_roles_with_capability('moodle/legacy:teacher', CAP_ALLOW)) {
				foreach ($roles as $role) {
					if (record_exists('role_assignments', 'roleid', $role->id, 'userid', $userid)) {
						return true;
					}
				}
			}
			return false;
		} else { //moodle < 1.7
			return record_exists('user_teachers', 'userid', $userid);
		}
	}
	/**
	 * Determines if a user is allowed to edit a given course
	 *
	 * - Copied from /lib/moodlelib.php & /lib/deprecatedlib.php without using $USER.
	 *
	 * @param int $courseid The id of the course that is being edited
	 * @param int $userid The id of the user that is being tested against.
	 * @return boolean
	 */
	function isteacheredit($courseid, $userid) {
		if ($this->isadmin($userid)) {
			return true;
		}
		if ($this->using17) {
			return has_capability('moodle/legacy:editingteacher', get_context_instance(CONTEXT_COURSE, $courseid), $userid, false);
		} else {
			return get_field('user_teachers', 'editall', 'userid', $userid, 'course', $courseid);
		}
	}
	/**
	 * Determines if a user can create new courses
	 *
	 * - Copied from /lib/moodlelib.php & /lib/deprecatedlib.php without using $USER.
	 *
	 * @param int $userid The user being tested.
	 * @return boolean
	 */
	function iscreator($userid) {
		if ($this->isadmin($userid)) {
			return true;
		}
		if ($this->using17) {
			return has_capability('moodle/legacy:coursecreator', get_context_instance(CONTEXT_SYSTEM, SITEID), $userid, false);
		} else {
			return record_exists('user_coursecreators', 'userid', $userid);
		}
	}
	/**
	 * Do server-side debugging output (to file).
	 *
	 * @uses $CFG
	 * @param mixed $output Debugging output.
	 * @return none
	 */
	function debug_output($output) {
		global $CFG;
		 if (DEBUG) {
			$fp = fopen($CFG->dataroot . '/debug.out', 'a');
			fwrite($fp, "[" . time() . "] $output\n");
			fflush($fp);
			fclose($fp);
		}
	}
	//PP BEGIN
	/**
	* determine the primary role of user in a course
	* @param int $client The client session record ID.
	* @param string $sesskey The session key returned by a previous login.
	* @param string userid
	* @param string useridfield
	* @param string courseid
	* @param string courseidfield
	* @return integer
	*          1 admin
	*          2 coursecreator
	*          3 editing teacher
	*          4 non editing teacher
	*          5 student
	*          6 guest IF course allows guest AND username ==guest
	*          0 nothing
	*/
	function get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield) {
		if (!$this->validate_client($client, $sesskey,'get_primaryrole_incourse')) {
			return $this->error('Invalid client connection.');
		}
		$cuid = $this->get_session_user($client);
		// convert user request criteria to an userid
		$user = get_record('user', $useridfield, $userid);
		if (!$user)
			return $this->error("user $useridfield='$userid' not found ");
		$userid = $user->id;
		// check rights
		if (($userid != $cuid) && !$this->isadmin($cuid))
			return $this->error("You do not have proper access to perform this operation.");
		// convert course request criteria to a courseid
		$course = get_record('course', $courseidfield, $courseid);
		if (!$course)
			return $this->error("course $courseidfield='$courseid' not found");
		$courseid = $course->id;
		if ($this->isadmin($userid))
			return 1;
		if ($this->iscreator($userid))
			return 2;
		if ($this->isteacheredit($courseid, $userid))
			return 3;
		if ($this->isteacher($courseid, $userid))
			return 4;
		//student
		// strange : guest has also the course:view capability ?
		// so we treat it before regular student
		//guest
		if ($this->using17) {
			$context = get_context_instance(CONTEXT_SYSTEM, SITEID);
			if (has_capability('moodle/legacy:guest', $context, $userid, false)) {
				if ($course->guest)
					return 6;
				else
					return 0;
			}
		} else {
			if (isguest($userid)) {
				if ($course->guest)
					return 6;
				else
					return 0;
			}
		}
		//student
		if ($this->using17) {
			$context = get_context_instance(CONTEXT_COURSE, $courseid);
			if (has_capability('moodle/course:view', $context, $userid, false))
				return 5;
		} else {
			if (isstudent($courseid, $userid))
				return 5;
		}
		return 0;
	}
	/**
	* determine if user has (at least) a given role in a course
	* @param int $client The client session record ID.
	* @param string $sesskey The session key returned by a previous login.
	* @param string userid
	* @param string useridfield
	* @param string courseid
	* @param string courseidfield
	* @param int roleid
	* @return boolean True if Ok , False otherwise.
	*/
	function has_role_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $roleid) {
		if (!$this->validate_client($client, $sesskey,'has_role_incourse')) {
			return $this->error('Invalid client connection.');
		}
		$cuid = $this->get_session_user($client);
		// convert user request criteria to an userid
		$user = get_record('user', $useridfield, $userid);
		if (!$user)
			return $this->error("user $useridfield='$userid' not found ");
		$userid = $user->id;
		// check rights
		if (($userid != $cuid) && !$this->isadmin($cuid))
			return $this->error("You do not have proper access to perform this operation.");
		// convert course request criteria to a courseid
		$course = get_record('course', $courseidfield, $courseid);
		if (!$course)
			return $this->error("course $courseidfield='$courseid' not found");
		$courseid = $course->id;

			$this->debug_output("HRIC $userid $courseid $roleid " . print_r($user, true) . "
			                             " . print_r($course, true));
		switch ($roleid) {
			case 1 :
				return $this->isadmin($userid);
				break;
			case 2 :
				return $this->iscreator($userid);
				break;
			case 3 :
				return $this->isteacheredit($courseid, $userid);
				break;
			case 4 :
				return $this->isteacher($courseid, $userid);
				break;
			case 5 : //student
				if ($this->using17) {
					$context = get_context_instance(CONTEXT_COURSE, $courseid);
					return has_capability('moodle/course:view', $context, $userid, false);
				} else {
					return isstudent($courseid, $userid);
				}
				break;
			case 6 : // guest TODO does not seems good since it does to check course
				if ($this->using17) {
					$context = get_context_instance(CONTEXT_SYSTEM, SITEID);
					return has_capability('moodle/legacy:guest', $context, $userid, false);
				} else {
					return isguest($userid);
				}
				break;
			default :
				if (!$this->using17) {
					return false;
				} else {
					//TODO search in mdl_roles_assignments
					return false;
				}
		}
	}
	/**
	     * Find and return a list of courses that a user is a member of.
	     *
	     * @param int $client The client session ID.
	     * @param string $sesskey The client session key.
	     * @param string $uinfo (optional) Moodle's id of user. If absent, uses current session user id
	     * @param string $idfield (default ='id', ignored if $uinfo is empty)
	     * @param string $sort requested order . Default fullname as per rev 1.5.11
	     * @return array Return data (course record) to be converted into a specific
	     *               data format for sending to the client.
	     */
	function get_my_courses($client, $sesskey, $uinfo = '', $idfield = 'id', $sort = '') {
		if (!$this->validate_client($client, $sesskey,'get_my_courses')) {
			return $this->error('Invalid client connection.');
		}
		$cuid = $this->get_session_user($client);
		if ($uinfo) {
			if ($idfield != 'id') { // find userid if not current user
				if (!$user = get_record('user', $idfield, $uinfo))
					return $this->error("user not found with $idfield= '$uinfo'");
				$uid = $user->id;
			} else
				$uid = $uinfo; // rev 1.5.10
		} else
			$uid = $cuid; //use current user and ignore $idfield
		//only admin user can request courses for others
		if ($uid != $cuid) {
			if (!$this->isadmin($cuid)) {
				return $this->error($cuid . ' You do not have proper access to perform this operation.');
			}
		}
		$sort = $sort ? $sort : 'fullname';
		if (isguest($uid)) //isguest is deprecated by still used in Moodle's 1.7 index.php ?
			//strange: courses with guest=1 and a password are not returned ?
			$res = get_records('course', 'guest', 1, $sort);
		else
			$res = get_my_courses($uid, $sort);
		if ($res)
			return $this->filter_courses($client, $res);
		else
			return $this->non_fatal_error("no courses");
	}
	/**
	  try to "emulate" Moodle 1.7 get_role_users at the best in Moodle 1.6
	*/
	private function get_role_users_16($client, $course, $idrole) {
		global $CFG;
		$select = 'SELECT u.* ';
		$where = 'WHERE s.course = ' . $course->id . ' AND u.deleted = 0 ';
		$order = 'order by lastname,firstname';
		switch ($idrole) {
			// case 0:; //all not permitted
			case 1 : //admin
				$from = 'FROM ' . $CFG->prefix . 'user u ,' . $CFG->prefix . 'user_admins s ';
				$where = 'WHERE  s.userid = u.id ';
				$this->debug_output($select . $from . $where . $order);
				if ($res = get_records_sql($select . $from . $where . $order)) {
					return $this->filter_users($client, $res);
				} else
					return $this->error("get_user_bycourse : no admins ???");
				break;
			case 2 : // creator
			case 3 : // teachers
			case 4 : // ne teacher
				$not = $idrole == 4 ? 'not' : '';
				$where .= ' and ' . $not . ' s.editall ';
				if ($idrole == 2)
					$where .= ' and s.authority=1 ';
				$from = 'FROM ' . $CFG->prefix . 'user u LEFT JOIN ' . $CFG->prefix . 'user_teachers s ON s.userid = u.id ';
				if ($res = get_records_sql($select . $from . $where . $order)) {
					return $this->filter_users($client, $res);
				} else
					return $this->non_fatal_error("get_user_bycourse : no match for student");
				break;
			case 5 : //students
				$from = 'FROM ' . $CFG->prefix . 'user u LEFT JOIN ' . $CFG->prefix . 'user_students s ON s.userid = u.id ';
				if ($res = get_records_sql($select . $from . $where . $order)) {
					return $this->filter_users($client, $res);
				} else
					return $this->non_fatal_error("get_user_bycourse : no match for student");
				break;
			case 6 :
				if ($course->guest) //guest
					return $this->filter_users($client, get_records('user', 'username', 'guest'));
				else
					return $this->non_fatal_error("get_user_bycourse : no match for guest");
				break; //guest
			default :
				return $this->error("Role ID is incorrect");
		}
	}
	function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole = 0) {
		if (!$this->validate_client($client, $sesskey,'get_users_bycourse')) {
			return $this->error('Invalid client connection.');
		}
		if (!$course = get_record('course', $idfield, $idcourse)) {
			return $this->error('Invalid course ' . $idfield . "=" . $courseid);
		}
		$cuid = $this->get_session_user($client);
		//only teacher or admin can do that ...
		if (!$this->isteacher($course->id, $cuid, true)) {
			return $this->error('You do not have proper access to perform this operation.');
		} else {
			if ($this->using17) {
				if ($idrole) {
					if (!record_exists('role', 'id', $idrole))
						return $this->error("Role ID is incorrect");
				}
				$context = get_context_instance(CONTEXT_COURSE, $course->id);
				// if ($res=get_role_users($idrole, $context, true, '*')) {   rev 1.5.12 01/07/2008
				if ($res = get_role_users($idrole, $context, true, '')) {
					return $this->filter_users($client, $res, $idrole);
				} else {
					return $this->non_fatal_error("get_user_bycourse : no match");
				}
			} else { //moodle < 1.7
				$ret = $this->get_role_users_16($client, $course, $idrole);
			}
		}
		// file_put_contents("$CFG->dataroot/debug_pp.log",'get_users_bycourse'.print_r($res,true));
		return $ret;
	}
	function get_roles($client, $sesskey, $roleid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey,'get_roles')) {
			return $this->error('Invalid client connection.');
		}
		$cuid = $this->get_session_user($client);
		//only teacher or admin can do that ...
		if (!$this->isteacherinanycourse($cuid, true)) {
			return $this->error('You do not have proper access to perform this operation.');
		} else {
			if ($this->using17) {
				// Get a list of all the roles in the database, sorted by their short names.
				if ($res = get_records('role', $idfield, $roleid, 'shortname, id', '*')) {
					return $res;
				} else {
					return $this->error("get_roles : search error");
				}
			} else
				return $this->non_fatal_error("get roles : no roles in Moodle <1.7");
		}
	}
	function get_categories($client, $sesskey, $catid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey,'get_categories')) {
			return $this->error('Invalid client connection.');
		}
		$ret = array ();
		// Get a list of all the categories in the database, sorted by their names.
		// TODO check permissions
		if ($res = get_records('course_categories', $idfield, $catid, 'name', '*')) {
			$ret = $this->filter_categories($client, $res);
		} else {
			return $this->error("get_categories : search error");
		}
		return $ret;
	}
	function get_events($client, $sesskey, $eventtype, $ownerid) {
		//NOT FINISHED
		/* TODO decide according to $eventype what to return
			global events
		          course events
		          group events
		          user's event
		          from calendar/lib.php function calendar_event_can_edit
		    if groupid is set, it's definitely a group event
		    else  if groupid is not set, but course is set,
		    it's definitively a course event
		    if course is not set, but userid id set, it's a user event
		    */
		if (!$this->validate_client($client, $sesskey,'get_events')) {
			return $this->error('Invalid client connection.');
		}
		$ret = array ();
		$cuid = $this->get_session_user($client);
		//only teacher or admin can do that ...
		if (!$this->isteacherinanycourse($cuid, true)) {
			return $this->error('You do not have proper access to perform this operation.');
		} else {
			// Get a list of all the events in the database, sorted by their short names.
			//TODO filter by eventype ...
			switch ($eventtype) {
				case cal_show_global :
					$idfield = 'courseid';
					$ownerid = 1;
					break;
				case cal_show_course :
					$idfield = 'courseid';
					break;
				case cal_show_group :
					$idfield = 'groupeid';
					break;
				case cal_show_user :
					$idfield = 'userid';
					break;
				default :
					$idfield = '';
					$ownerid = '';
			}
			if ($res = get_records('event', $idfield, $ownerid)) {
				foreach ($res as $r) {
					$r = $this->filter_event($client, $eventtype, $r);
					if ($r)
						$ret[] = $r;
				}
			} else {
				return $this->error("get_events : search error");
			}
		}
		return $ret;
	}
	function get_group_members($client, $sesskey, $groupid) {
		if (!$this->validate_client($client, $sesskey,'get_group_members')) {
			return $this->error('Invalid client connection.');
		}
		if (!record_exists('groups', 'id', $groupid)) {
			return $this->error('Invalid group ' . $groupid);
		}
		$res = get_group_users($groupid);
		if (!$res)
			return $this->error('no group members.' . $groupid);
		return $this->filter_users($client, $res, 0);
	}
	function get_my_id($client, $sesskey) {
		if (!$this->validate_client($client, $sesskey)) {
			return -1; //invalid Moodle's ID
		}
		return $this->get_session_user($client);
	}
	function get_groups_bycourse($client, $sesskey, $courseid, $idfield = 'idnumber') {
		if (!$this->validate_client($client, $sesskey,'get_groups_bycourse')) {
			return $this->error('Invalid client connection.');
		}
		if (!$course = get_record('course', $idfield, $courseid)) {
			return $this->error('Invalid course ' . $idfield . "=" . $courseid);
		}
		$res = get_groups($course->id);
		//file_put_contents('$CFG->dataroot/debug_pp.log',
		//  'get_groups_bycourse'.print_r($res,true));
		if (!$res)
			return $this->non_fatal_error('no groups in course.' . $courseid);
		return $this->filter_groups($client, $res);
	}
	function get_groups($client, $sesskey, $groups, $idfield, $courseid) {
		if (empty ($groups) && $courseid) {
			return $this->get_groups_bycourse($client, $sesskey, $courseid);
		}
		if (!$this->validate_client($client, $sesskey,'get_groups')) {
			return $this->error('Invalid client connection.');
		}
		global $CFG;
		$ret = array ();
		if ($courseid) {
			$courseselect = 'AND g.courseid =' . $courseid;
		} else {
			$courselect = '';
		}
		foreach ($groups as $group) {
			$sql = "SELECT g.*
			                                FROM {$CFG->prefix}groups g
			        	                     WHERE g.$idfield ='$group' $courseselect ";
			$rgroup = new StdClass();
			/// This database operation MIGHT throw an HTML error message,
			/// so we've got to catch that and send it back in an error
			/// request.
			ob_start();
			$g = get_records_sql($sql);
			if (ob_get_length() && trim(ob_get_contents())) {
				/// Return an error with  the contents of the output buffer.
				$msg = trim(ob_get_clean());
				$ret[] = $this->error('Database error: ' . $msg);
			}
			ob_end_clean();
			if (!empty ($g)) {
				$g = $this->filter_groups($client, $g);
				foreach ($g as $one) {
					$ret[] = $one;
				}
			} else {
				$ret[] = $this->non_fatal_error("Invalid group $idfield :$group ");
			}
		}
		return $ret;
	}
	/**
	 * Returns the user's groups in all courses (not found in Moodle API)
	 *
	 * @uses $CFG
	 * @param int $uid The id of the user as found in the 'user' table.
	 *         if empty, return logged in user's groups
	 *         if uid is not equal to current's user id, current user must be admin.
	 * @return array of object
	 */
	function get_my_groups($client, $sesskey, $uid) {
		if (!$this->validate_client($client, $sesskey,'get_mygroups')) {
			return $this->error('Invalid client connection.');
		}
		$cuid = $this->get_session_user($client);
		if (!empty ($uid) && ($uid != $cuid))
			if (!$this->isadmin($cuid))
				return $this->error("only admins can do that");
		global $CFG;
		$uid = $uid ? $uid : $cuid;
		$sql = "SELECT g.*
		                      FROM {$CFG->prefix}groups g,
		                      {$CFG->prefix}groups_members m
		                      WHERE g.id = m.groupid
		                      AND m.userid = '$uid'
		                      ORDER BY name ASC";
		$res = get_records_sql($sql);
		//file_put_contents("$cfg->dataroot/debug_pp.log",'server:get_my_groups '.$sql.' '.print_r($res,true));
		return $this->filter_groups($client, $res);
	}
	function get_last_changes($client, $sesskey, $courseid, $idfield = 'idnumber', $limit = 10) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'get_last_changes')) {
			return $this->error('Invalid client connection.');
		}
		if (!$course = get_record('course', $idfield, $courseid)) {
			return $this->error('Invalid course ' . $idfield . "=" . $courseid);
		}
		$cuid = $this->get_session_user($client);
		$isTeacher = $this->isteacher($course->id, $cuid);
		//must have id as first field for proper array indexing !
		$sqlAct =<<<EOS
		SELECT DISTINCT {$CFG->prefix}log.id,module, {$CFG->prefix}log.url, info,
time,firstname,lastname,email,
		action , cmid, course, time, FROM_UNIXTIME( time, '%d/%m/%Y %H:%i:%s' ) AS DATE_J
		FROM {$CFG->prefix}log inner join {$CFG->prefix}user on
{$CFG->prefix}log.userid={$CFG->prefix}user.id
		WHERE course =$course->id
		and (action like 'add%' or action like 'update%')
		and cmid <>0
		and module <>'label'
		ORDER BY time DESC
EOS;
		$return = array ();
		if (!$resultAct = get_records_sql($sqlAct)) {
			return $this->non_fatal_error("nada");
		}
		foreach ($resultAct as $rowAct) {
			if ($limit-- <= 0)
				break;
			$id_cmid = $rowAct->cmid;
			$id_autre = "cmid=$id_cmid ";
			$sql =<<<EOS
			select {$CFG->prefix}modules.*,{$CFG->prefix}course_modules.instance,{$CFG->prefix}course_modules.visible
			from {$CFG->prefix}course_modules,{$CFG->prefix}modules
			where course=$course->id
			and {$CFG->prefix}course_modules.module={$CFG->prefix}modules.id
			and {$CFG->prefix}course_modules.id =$id_cmid
EOS;
			// toutes pour un prof, seulement les ressources visibles pour un �tudiant !!!
			if (!$isTeacher) {
				$sql .= " and {$CFG->prefix}course_modules.visible=1";
			}
			if ($row = get_record_sql($sql)) {
				$sql1 =<<<EOS
				select * from {$CFG->prefix}{$row->name}
				where id={$row->instance}
				and course=$course->id
EOS;
				$result1 = get_records_sql($sql1);
				foreach ($result1 as $row1) {
					if ($row1->name) {
						//retouche  ?id=cc&r=xx ou ?f=xx
						switch ($row->name) {
							case 'forum' :
								$question = "view.php?f=$row1->id";
								break;
							case 'assignment' :
								$question = "submissions.php?id=$id_cmid";
								break;
							default :
								$question = "view.php?id=$course->id&r=$row1->id";
						}
						$ret = new StdClass;
						$ret->error = '';
						$ret->id = $rowAct->id;
						$ret->courseid = $courseid;
						$ret->instance = $row->instance;
						$ret->resid = $row1->id;
						$ret->name = $row1->name;
						$ret->date = $rowAct->DATE_J;
						$ret->timestamp = $rowAct->time;
						$ret->type = $rowAct->action;
						$ret->author = "$rowAct->firstname $rowAct->lastname";
						$ret->url = $rowAct->url;
						$ret->link = $CFG->wwwroot . '/mod/' . $row->name . '/' . $question;
						$ret->visible = $row->visible;
						$return[] = $ret;
					}
				}
			}
		}

			$this->debug_output(print_r($return, true));
		return $this->filter_changes($client, $return);
	}
	function get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, $doCount = 0) {
		if (!$this->validate_client($client, $sesskey,'get_activities')) {
			return $this->error('Invalid client connection.');
		}
		//resolve user criteria to an user  Moodle's id
		if (!$user = get_record('user', $useridfield, $userid)) {
			return $this->error('Invalid user ' . $useridfield . "=" . $userid);
		}
		$cuid = $this->get_session_user($client);
		if ($courseid) {
			//resolve course criteria to a course Moodle's id
			if (!$course = get_record('course', $courseidfield, $courseid))
				return $this->error('Invalid course ' . $courseidfield . "=" . $courseid);
			$sql_course = " AND  l.course=$course->id ";
			$canRead = $this->isteacher($course->id, $cuid);
		} else {
			$sql_course = '';
			$canRead = $this->isadmin($cuid);
		}
		if (($cuid != $user->id) && !$canRead) {
			return $this->error('You do not have proper access to perform this operation');
		}
		if ($doCount)			// caution result MUST have some id value to fetch result later
			$sql_select = " SELECT 1,count(l.userid) as CPT ";
		else {
			$sql_select =<<<EOS

SELECT l.*,u.auth,u.firstname,u.lastname,u.email,
u.firstaccess, u.lastaccess, u.lastlogin, u.currentlogin,
FROM_UNIXTIME(l.time,'%d/%m/%Y %H:%i:%s' )as DATE,
FROM_UNIXTIME(u.lastaccess,'%d/%m/%Y %H:%i:%s' )as DLA,
FROM_UNIXTIME(u.firstaccess,'%d/%m/%Y %H:%i:%s' )as DFA,
FROM_UNIXTIME(u.lastlogin,'%d/%m/%Y %H:%i:%s' )as DLL,
FROM_UNIXTIME(u.currentlogin,'%d/%m/%Y %H:%i:%s' )as DCL
EOS;
		}
		$sql =<<<EOSS
$sql_select
FROM mdl_log l , mdl_user u
WHERE l.userid = u.id
AND u.id = $user->id
$sql_course
ORDER BY l.time DESC
EOSS;
		//$this->debug_output($sql);
		$res = get_records_sql($sql, '', $limit);
		//$this->debug_output(print_r($res,true));
		if ($doCount)
			return $res['1']->CPT; //caution
		else
			return $this->filter_activities($client, $res);
		//reconvert dates using userdate()
	}
	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 START LILLE FUNCTIONS                                                     *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/
	/*
	* Comments:
	* All the affect methods are returning a generic object type named affectRecord
	* This object has two fields: status and error
	*       status indicates if operation succeded
	*       if status=false then the error field contains the coresponding error message
	*/
	//Utility functions
	function has_capabilities($client, $sesskey, $capability, $context_type, $instance_id) {
		$context = get_context_instance($context_type, $instance_id);
		$myId = $this->get_my_id($client, $sesskey);
		return has_capability($capability, $context, $myId);
	}
	///Utility functions
	/**
	* Edit label records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $labels An array of label records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (label record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_labels($client, $sesskey, $labels) {
		global $CFG;
		require_once ("{$CFG->dirroot}/mod/label/lib.php");
		if (!$this->validate_client($client, $sesskey,'edit_labels')) {
			return $this->error('EDIT_LABELS:   Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($labels)) {
			foreach ($labels->labels as $label) {
				switch ($label->action) {
					case 'Add' :
						/// Adding a new label.
						$labeladd = $label;

							$this->debug_output('EDIT_LABELS:    Trying to add a new label.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rlabel->error = "EDIT_LABELS:     You do not have proper access to perform this operation.";
							break;
						}
						//verify if current label is already in database
						if ($labelExist = get_record("label", "course", $label->course, "name", $label->name, "content", $label->content)) {
							$rlabel = $labelExist;
							break;
						}
						//function label_add_instance has a bug in moodle
						/*
						in file mod\label\lib.php
						function label_add_instance calls get_label_name
						inside get_label_name variable name is colected from content field and not from name
						$name = addslashes(strip_tags(format_string(stripslashes($label->content),true)));
						*/
						if (!$labelid = label_add_instance($labeladd)) {
							$rlabel->error = "EDIT_LABELS:     Could not insert the new label: $labeladd->name";
							break;
						}
						$rlabel = get_record('label', 'id', $labelid);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rlabel->error = 'EDIT_LABELS:  Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rlabel->error = "EDIT_LABELS:  Operation Update not implemented yet!";
						break;
					case 'Delete' :
						$rlabel->error = "EDIT_LABELS:  Operation Delete not implemented yet!";
						break;
					default :
						$rlabel->error = "EDIT_LABELS:   Invalid operation: $label->action.";
				}
				$ret[] = $rlabel;
			}
		}
		return $ret;
	}
	/**
	* Edit category records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $categories An array of category records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (category record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_categories($client, $sesskey, $categories) {
		global $CFG;
		require_once ("{$CFG->dirroot}/course/lib.php");
		if (!$this->validate_client($client, $sesskey,'edit_categories')) {
			return $this->error('EDIT_CATEGORIES:    Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($categories)) {
			foreach ($categories->categories as $category) {
				switch ($category->action) {
					case 'Add' :
						/// Adding a new category.
						$categoryadd = $category;

							$this->debug_output('EDIT_CATEGORIES:    Trying to add a new category.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:create', CONTEXT_SYSTEM, 0)) {
							$rcategory->error = "EDIT_CATEGORIES:   You do not have proper access to perform this operation.";
							break;
						}
						//verify if current category is already in db
						if ($catExist = get_record("course_categories", "name", $category->name, "description", $category->description)) {
							$rcategory = $catExist;
							break;
						}
						$categoryadd->sortorder = 999;
						if (!$categoryadd->id = insert_record('course_categories', $categoryadd)) {
							$rcategory->error = "EDIT_CATEGORIES:    Could not insert the new category '$categoryadd->name' ";
							break;
						}
						$categoryadd->context = get_context_instance(CONTEXT_COURSECAT, $categoryadd->id);
						mark_context_dirty($categoryadd->context->path);
						if (empty ($categoryadd->id)) {
							$rcategory->error = 'EDIT_CATEGORIES:   Could not add category: ' . $categoryadd->shortname;
							break;
						}
						$rcategory = get_record('course_categories', 'id', $categoryadd->id);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rcategory->error = 'EDIT_CATEGORIES:   Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						/// Updating an existing category.
						$cid = $category->id;
						$cname = $category->name;

							$this->debug_output('EDIT_CATEGORIES:    Attempting to update category ID: ' . $cid . print_r($category, true));
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						if (!$this->has_capabilities($client, $sesskey, "moodle/category:update", CONTEXT_SYSTEM, 0)) {
							$rcategory->error = 'EDIT_CATEGORIES:  You do not have proper access to perform this operation.';
							break;
						}
						if (!$database_category = get_record('course_categories', 'id', $cid)) {
							$rcategory->error = 'EDIT_CATEGORIES:   Could not find category ID: ' . $cid;
							break;
						}
						/// Update values in the category database record with what
						/// the client supplied.
						foreach ($category as $key => $value) {
							if (!empty ($value)) // rev 1.5.15 must ignore empty values ! serious flaw !
								$database_category-> $key = $value;
						}
						$database_category->timemodified = time();
						if (!$success = update_record('course_categories', $database_category)) {
							$rcategory->error = 'EDIT_CATEGORIES:   Could not update category: ' . $cid;
							break;
						}
						fix_course_sortorder();
						$rcategory = get_record('course_categories', 'id', $database_category->id);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$rcategory->error = 'EDIT_CATEGORIES:   Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Delete' :
						/// Deleting an existing category.
						$cname = $category->name;
						$cid = $category->id;

							$this->debug_output('EDIT_CATEGORIES:    Attempting to delete category ID: ' . $cid);
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, "moodle/category:delete", CONTEXT_SYSTEM, 0)) {
							$rcategory->error = 'EDIT_CATEGORIES:   You do not have proper access to perform this operation.';
							break;
						}
						//initial no record found and none deleted
						$deleted_commit = false;
						if (!$categories = get_records("course_categories", "", "", "id,name")) {
							$rcategory->error = "EDIT_CATEGORIES:   Could not find category ID: $cid or name: $cname";
							break;
						}
						foreach ($categories as $_category) {
							if ($_category->id == $cid || $_category->name == $cname) {
								//at least a record was found and deleted
								$deleted_commit = true;
								$rcategory = $_category;
								//we delete the courses of that category and theirs students and teachers
								//Lille bug found
								//category_delete_full's second parameter should notify the function not to print status messages
								//it doesn't work...this case it's not implemented inside the course/lib.php library function
								if (!category_delete_full($_category, false)) {
									$rcategory->error = "EDIT_CATEGORIES: Error deleting category with id: $_category->id";
									break;
								}
								//this should be removed after the mentioned bug will be fixed
								ob_clean();
							}
						}
						if (!$deleted_commit) {
							$rcategory->error = "EDIT_CATEGORIES:   Could not delete category with id $cid or name $cname.";
							break;
						}
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$rcategory->error = 'EDIT_CATEGORIES:   Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					default :
						$rcategory->error = "EDIT_CATEGORIES:   Invalid operation: $category->action.";
						break;
				}
				$ret[] = $rcategory;
			}
		}
		return $ret;
	}
	/**
	* Edit section records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $sections An array of section records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (section record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_sections($client, $sesskey, $sections) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey,'edit_sections')) {
			return $this->error('EDIT_SECTIONS:   Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($sections)) {
			foreach ($sections->sections as $section) {
				switch ($section->action) {
					case 'Add' :
						/// Adding a new section.
						$sectionadd = $section;

							$this->debug_output('EDIT_SECTIONS:    Trying to add a new section.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:update', CONTEXT_SYSTEM, 0)) {
							$rsection->error = "EDIT_SECTIONS: You do not have proper access to perform this operation.";
							break;
						}
						// verify if current section is already in database
						if ($sectionExist = get_record("course_sections", "course", $section->course, "section", $section->section)) {
							$rsection = $sectionExist;
							break;
						}
						if (!$resultInsertion = insert_record("course_sections", $sectionadd)) {
							$rsection->error = "EDIT_SECTIONS:  Could not insert the new section: $sectionadd->name";
							break;
						}
						$rsection = get_record('course_sections', 'id', $resultInsertion);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rsection->error = 'EDIT_SECTIONS:    Database error: ' . $msg;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rsection->error = "EDIT_SECTIONS:  Operation Update not implemented yet!";
						break;
					case 'Delete' :
						$rsection->error = "EDIT_SECTIONS:  Operation Delete not implemented yet!";
						break;
					default :
						$rsection->error = "EDIT_SECTIONS:   Invalid operation: $section->action.";
				}
				$ret[] = $rsection;
			}
		}
		return $ret;
	}
	/**
	* Edit forum records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $forums An array of forum records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (forum record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_forums($client, $sesskey, $forums) {
		global $CFG;
		require_once ("{$CFG->dirroot}/mod/forum/lib.php");
		if (!$this->validate_client($client, $sesskey,'edit_forums')) {
			return $this->error('EDIT_FORUMS:    Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($forums)) {
			foreach ($forums->forums as $forum) {
				switch ($forum->action) {
					case 'Add' :
						/// Adding a new forum.
						$forumadd = $forum;

							$this->debug_output('EDIT_FORUMS:     Trying to add a new forum.');
						if (empty ($forumadd->type)) {
							$forumadd->type = "general";
						}
						if (!array_key_exists($forumadd->type, forum_get_forum_types_all())) {
							$rforum->error = "EDIT_FORUMS:     Wrong forum type specificated! ";
							break;
						}
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rforum->error = "EDIT_FORUMS:     You do not have proper access to perform this operation.";
							break;
						}
						//verify if current forum is already in database
						if ($forumExist = get_record("forum", "course", $forum->course, "type", $forum->type, "name", $forum->name)) {
							$rforum = $forumExist;
							break;
						}
						if (!$resultInsertion = forum_add_instance($forumadd)) {
							$rforum->error = "EDIT_FORUMS:     Could not insert the new forum: $forumadd->name";
							break;
						}
						$rforum = get_record('forum', 'id', $resultInsertion);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rforum->error = 'EDIT_FORUMS:     Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rforum->error = "EDIT_FORUMS:     Operation Update not implemented yet!";
						break;
					case 'Delete' :
						$rforum->error = "EDIT_FORUMS:     Operation Delete not implemented yet!";
						break;
					default :
						$rforum->error = "EDIT_FORUMS:     Invalid operation: $forum->action.";
				}
				$ret[] = $rforum;
			}
		}
		return $ret;
	}
	/**
	* Edit group records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $groups An array of group records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (group record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_groups($client, $sesskey, $groups) {
		global $CFG;
		require_once ($CFG->libdir . '/moodlelib.php');
		if (!$this->validate_client($client, $sesskey,'edit_groups')) {
			return $this->error('EDIT_GROUPS: Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($groups)) {
			foreach ($groups->groups as $group) {
				switch ($group->action) {
					case 'Add' :
						/// Adding a new group.
						$groupadd = $group;

							$this->debug_output('EDIT_GROUPS: Trying to add a new group.');
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
							$rgroup->error = 'EDIT_GROUPS:  You do not have proper access to perform this operation.';
							break;
						}
						//verify if current group is already in db
						if ($groupExist = get_record("groups", "courseid", $group->courseid, "name", $group->name, "description", $group->description)) {
							$rgroup = $groupExist;
							break;
						}
						$groupadd->picture = 0;
						$groupadd->hidepicture = 0;
						$groupadd->timecreated = time();
						$groupadd->timemodified = time();
						$groupadd->id = insert_record('groups', $groupadd);
						if (empty ($groupadd->id)) {
							$rgroup->error = 'EDIT_GROUPS:  Could not add the group: ' . $groupadd->name;
							break;
						}
						$rgroup = get_record('groups', 'id', $groupadd->id);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rgroup->error = 'EDIT_GROUPS:  Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						/// Updating an existing group
						ob_start();
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
							$rgroup->error = 'EDIT_GROUPS:  You do not have proper access to perform this operation.';
							break;
						}
						$groupup = $group;
						$gid = $groupup->id;

							$this->debug_output('EDIT_GROUPS:    Attempting to update group ID: ' . $gid . print_r($group, true));
						$group = get_record('groups', 'id', $gid);
						if (!$group) {
							$rgroup->error = "EDIT_GROUPS:    Could not find group ID: $gid";
							break;
						}
						foreach ($groupup as $key => $value) {
							if (!empty ($value))
								$group-> $key = $value;
						}
						$group->timemodified = time();
						$success = update_record('groups', $group);
						if (!$success) {
							$rgroup->error = 'EDIT_GROUPS:  Could not update group: ' . $gid;
							break;
						} else {
							$rgroup = get_record('groups', 'id', $group->id);
						}
						if (ob_get_length() && trim(ob_get_contents())) {
							$msg = trim(ob_get_clean());
							$rgroup->error = 'EDIT_GROUPS:  Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Delete' :
						/// Deleting an existing group.
						$gid = $group->id;
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
							$rgroup->error = 'EDIT_GROUPS:  You do not have proper access to perform this operation.';
							break;
						}

							$this->debug_output('EDIT_GROUPS:    Attempting to delete group ID: ' . $gid);
						$group = get_record('groups', 'id', $gid);
						if (!$group) {
							$rgroup->error = 'EDIT_GROUPS:  Could not find group ID: ' . $gid;
							break;
						}
						if (!groups_delete_group($gid)) {
							$rgroup->error = 'This  group no exist or is not deleted';
							break;
						} else {
							$rgroup = $group;
						}
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_clean());
							$rgroup->error = 'EDIT_GROUPS:  Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					default :
						$rgroup->error = "EDIT_GROUPS: Invalid action " . $group->action;
						break;
				}
				$ret[] = $rgroup;
			}
		}
		return $ret;
	}
	/**
	* Edit assgnment records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $assignments An array of assignments records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (assignment record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_assignments($client, $sesskey, $assignments) {
		global $CFG;
		require_once ("{$CFG->dirroot}/mod/assignment/lib.php");
		require_once ("{$CFG->dirroot}/course/lib.php");
		if (!$this->validate_client($client, $sesskey,'edit_assignments')) {
			return $this->error = 'EDIT_ASSIGNMENT:   Invalid client connection.';
		}
		$ret = array ();
		if (!empty ($assignments)) {
			foreach ($assignments->assignments as $assignment) {
				switch ($assignment->action) {
					case 'Add' :
						$assignmentadd = $assignment;
						//creation of the new assignment
						ob_start();
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rassignment->error = 'EDIT_ASSIGNMENTS:     You do not have proper access to perform this operation.';
							break;
						}
						// verification of the field  "assignmenttype"
						$assignmentadd->assignmenttype == "" ? $assignmentadd->assignmenttype = "online" : "";
						if (($assignmentadd->assignmenttype != "online") && ($assignmentadd->assignmenttype != "upload") && ($assignmentadd->assignmenttype != "uploadsingle") && ($assignmentadd->assignmenttype != "offline")) {
							$rassignment->error = "EDIT_ASSIGNMENTS:     The type specified isn't a valid type";
							break;
						}
						//verify if current assignment is already in database
						if ($assignmentExist = get_record("assignment", "assignmenttype", $assignment->assignmenttype, "name", $assignment->name, "description", $assignment->description)) {
							$rassignment = $assignmentExist;
							break;
						}
						$add->name = $assignmentadd->name;
						$add->assignmenttype = $assignmentadd->assignmenttype;
						$add->description = $assignmentadd->description;
						$add->timeavailable = time();
						$add->timedue = time() + 7 * 24 * 3600;
						$add->preventate = 0;
						if (!($assignId = assignment_add_instance($add))) {
							$rassignment->error = "EDIT_ASSIGNMENTS:  Could not create assignment instance with name: $add->name";
							break;
						}
						$add->id = $assignId;
						$rassignment = $add;
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rassignment->error = 'EDIT_ASSIGNMENTS:    Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rassignment->error = "EDIT_ASSIGNMENTS:     Operation Update not implemented.";
						break;
					case 'Delete' :
						//delete assignment
						$del = $assignment;
						ob_start();
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rassignment->error = 'EDIT_ASSIGNMENTS: You do not have proper access to perform this operation.';
							break;
						}
						$assign = get_record("assignment", "id", $del->id);
						if (!$assign) {
							$rassignment->error = "EDIT_ASSIGNMENTS: Assignment with id $del->id not found.";
							break;
						}
						$delete = assignment_delete_instance($del->id);
						if (!($delete)) {
							$rassignment->error = "EDIT_ASSIGNMENTS: The instance with id $del->id can't be deleted";
							break;
						}
						$module = get_record("modules", "name", "assignment");
						if (!$module) {
							$rassignment->error = "EDIT_ASSIGNMENTS: Assignment module wasn't found";
							break;
						}
						$course_mod = get_record("course_modules", "course", $assign->course, "module", $module->id, "instance", $del->id);
						if ($course_mod) {
							if (!delete_records("course_modules", "id", $course_mod->id)) {
								$rassignment->error = "EDIT_ASSIGNMENTS:     Error on deleting in COURSE_MODULES";
								break;
							}
							delete_mod_from_section($course_mod->id, $course_mod->section);
						}
						$rassignment = $assign;
						//delete_mod_from_section
						if (ob_get_length() && trim(ob_get_contents())) {
							$msg = trim(ob_get_contents());
							$rassignment->error = 'EDIT_ASSIGNMENTS: Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					default :
						$rassignment->error = "EDIT_ASSIGNMENTS: Invalid action " . $assignment->action;
						break;
				}
				$ret[] = $rassignment;
			}
		}
		return $ret;
	}
	/**
	* Edit database records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $databases An array of database records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (database record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_databases($client, $sesskey, $databases) {
		global $CFG;
		require_once ("{$CFG->dirroot}/mod/data/lib.php");
		if (!$this->validate_client($client, $sesskey,'edit_database')) {
			return $this->error = 'EDIT_ASSIGNMENT:   Invalid client connection.';
		}
		$ret = array ();
		if (!empty ($databases)) {
			foreach ($databases->databases as $database) {
				switch ($database->action) {
					case 'Add' :
						//add a new database
						$dtbadd = $database;
						ob_start();
						if (!$this->has_capabilities($client, $sesskey, 'moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {

								$this->debug_output("EDIT_DATABASES:     Invalid access UID: $dtbadd");
							$rdatabase->error = 'EDIT_DATABASES:    You do not have proper access to perform this operation.';
							break;
						}
						if (empty ($dtbadd->name)) {
							$rdatabase->error = "EDIT_DATABASES:    The name of the database is missing";
							break;
						}
						//does the database exist?
						if ($dtb = get_record("data", "course", $dtbadd->course, "name", $dtbadd->name, "intro", $dtbadd->intro)) {
							$rdatabase = $dtb;
							break;
						}
						// database creation
						if (!$dtb = data_add_instance($dtbadd)) {
							$rdatabase->error = "EDIT_DATABASES:    This database could't be saved";
							break;
						}
						$rdatabase = $dtbadd;
						if (ob_get_length() && trim(ob_get_contents())) {
							$msg = trim(ob_get_contents());
							$rdatabase->error = 'EDIT_DATABASES:    Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						//not implemented
						$rdatabase->error = "EDIT_DATABASES:    The action UPDATE is'n implemented";
						break;
					case 'Delete' :
						//not implemented
						$rdatabase->error = "EDIT_DATABASES:    The action DELETE is'n implemented";
						break;
					default :
						$rdatabase->error = "EDIT_DATABASES:     This action isn't defined " . $database->action;
						break;
				}
				$ret[] = $rdatabase;
			}
		}
		return $ret;
	}
	/**
	* Edit wiki records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $wikis An array of wiki records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (wiki record) to be converted into a
	*               specific data format for sending to the client.
	*/
	function edit_wikis($client, $sesskey, $wikis) {
		global $CFG;
		require_once ($CFG->dirroot . '/mod/wiki/lib.php');
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey,'edit_wikis')) {
			return $this->error('EDIT_WIKIS:     Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($wikis)) {
			foreach ($wikis->wikis as $wiki) {
				switch ($wiki->action) {
					case 'Add' :

							$this->debug_output('EDIT_WIKIS:     Trying to add a new wiki.');
						/// Adding a new wiki
						$wikiadd = $wiki;
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rwiki->error = "EDIT_WIKIS:     You do not have proper access to perform this operation.";
							break;
						}
						//verify if current wiki is already in database
						if ($wikiExist = get_record("wiki", "name", $wiki->name, "course", $wiki->course)) {
							$rwiki = $wikiExist;
							break;
						}
						$wikiadd->pagename = empty ($wikiadd->pagename) ? $wikiadd->name : $wikiadd->pagename;
						$wikiadd->wtype = empty ($wikiadd->wtype) ? 'group' : $wikiadd->wtype;
						if ($wikiadd->wtype != 'group' && $wikiadd->wtype != 'teacher' && $wikiadd->wtype != 'student') {
							$rwiki->error = "EDIT_WIKIS:     The type of wiki is incorrect.";
							break;
						}
						//add instance of wiki
						if (!($wikiId = wiki_add_instance($wikiadd))) {
							$rwiki = "EDIT_WIKIS:     It is impossible to create an instance of wiki.";
							break;
						}
						$wikiadd->id = $wikiId;
						$my_id = $this->get_my_id($client, $sesskey);
						$wiki_entry->wikiid = $wikiadd->id;
						$wiki_entry->course = 0;
						$wiki_entry->groupid = 0;
						$wiki_entry->userid = $my_id;
						$wiki_entry->pagename = $wikiadd->pagename;
						if (!$result = insert_record("wiki_entries", $wiki_entry)) {
							$rwiki->error = "EDIT_WIKIS:     Error inserting a new record in wiki_entries";
							break;
						}
						$rwiki = get_record('wiki', 'id', $wikiId);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rwiki->error = 'EDIT_WIKIS:     Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rwiki->error = "EDIT_WIKIS:  Operation Update not implemented yet";
						break;
					case 'Delete' :

							$this->debug_output('EDIT_WIKIS:     Trying to remove wiki.');
						$wikidelete = $wiki;
						$wikiId = $wikidelete->id;
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rwiki->error = "EDIT_WIKIS:     You do not have proper access to perform this operation.";
							break;
						}
						if (!$module = get_record("modules", "name", "wiki")) {
							$rwiki->error = "EDIT_WIKIS:     Module wiki was not found";
							break;
						}
						if (!$_wiki = get_record("wiki", "id", $wikiId)) {
							$rwiki->error = "EDIT_WIKIS:     The wiki was not found";
							break;
						}
						if (!($delete = wiki_delete_instance($wikiId))) {
							$rwiki->error = "EDIT_WIKIS:     It is impossible to delete the instance of wiki.";
							break;
						}
						$course_module = get_record("course_modules", "course", $_wiki->course, "module", $module->id, "instance", $wikiId);
						if (!(delete_records("course_modules", "course", $_wiki->course, "module", $module->id, "instance", $wikiId))) {
							$rwiki->error = "EDIT_WIKIS:     Error in deleting wiki from database.";
							break;
						}
						// removes from course_sections
						if (!delete_mod_from_section($course_module->id, $course_module->section)) {
							$rwiki->error = "EDIT_WIKIS:     Error in deleting  from course_sections.";
						}
						$rwiki = $_wiki;
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rwiki->error = 'EDIT_WIKIS:     Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					default :
						$rpage->error = "EDIT_WIKIS:  This option was not implemented ";
				}
				$ret[] = $rwiki;
			}
		}
		return $ret;
	}
	/**
	* Edit page of Wiki records (add/update/delete).
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $pagesWiki An array of page of wiki records (objects or arrays) for editing
	*                     (including operation to perform).
	* @return array Return data (page wiki record) to be converted into a
	*               specific data format for sending to the client.
	*
	*/
	function edit_pagesWiki($client, $sesskey, $pagesWiki) {
		global $CFG;
		require_once ($CFG->dirroot . '/mod/wiki/lib.php');
		if (!$this->validate_client($client, $sesskey,'edit_pagesWiki')) {
			return $this->error('EDIT_PAGESWIKI:     Invalid client connection.');
		}
		$ret = array ();
		if (!empty ($pagesWiki)) {
			foreach ($pagesWiki->pagesWiki as $page) {
				switch ($page->action) {
					case 'Add' :

							$this->debug_output('EDIT_PAGESWIKI:     Trying to add a new pageWiki.');
						$pageadd = $page;
						$pageadd->userid = $this->get_my_id($client, $sesskey);
						$pageadd->created = time();
						$pageadd->lastmodified = time();
						ob_start();
						/// Check for correct permissions.
						if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							$rpage->error = "EDIT_PAGESWIKI:     You do not have proper access to perform this operation.";
							break;
						}
						//verify if current page is already in database
						if ($pg = get_record("wiki_pages", "pagename", $pageadd->pagename, "wiki", $pageadd->wiki)) {
							$rpage = $pg;
							break;
						}
						if (!$resultInsertion = insert_record("wiki_pages", $pageadd)) {
							$rpage->error = "EDIT_PAGESWIKI:     Error at insertion of the page.";
							break;
						}
						$rpage = get_record('wiki_pages', 'id', $resultInsertion);
						if (ob_get_length() && trim(ob_get_contents())) {
							/// Return an error with  the contents of the output buffer.
							$msg = trim(ob_get_contents());
							$rpage->error = 'EDIT_PAGESWIKI:     Database error: ' . $msg;
							break;
						}
						ob_end_clean();
						break;
					case 'Update' :
						$rpage->error = "EDIT_PAGESWIKI:     Operation Update was not implemented yet";
						break;
					case 'Delete' :
						$rpage->error = "EDIT_PAGESWIKI:     Operation Delete was not implemented yet";
						break;
					default :
						$rpage->error = "EDIT_PAGESWIKI:     Invalid operation: $page->action";
				}
			}
			$ret[] = $rpage;
		}
		return $ret;
	}
	/**
	* Add label to course section
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $labelid The label's id
	* @return array Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_label_to_section($client, $sesskey, $labelid, $sectionid) {
		global $CFG;
		require_once ($CFG->dirroot . '/lib/accesslib.php');
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey,'affect_label_to_section')) {
			return $this->error('AFFECT_LABEL_TO_SECTION:     Invalid client connection.');
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.
		ob_start();
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     You do not have proper access to perform this operation");
		}
		//get the label module
		if (!$module_type = get_record("modules", "name", "label")) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Module type label not found!");
		}
		//get the label record
		if (!($label = get_record('label', 'id', $labelid))) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error finding the label with id=$labelid");
		}
		//verify if this label is already assigned to this section
		if ($isAssigned = get_record("course_modules", "module", $module_type->id, "instance", $labelid))
			return $this->error("AFFECT_LABEL_TO_SECTION:  Label with ID $labelid is already assigned to section with ID $isAssigned->section");
		$course_module->instance = $labelid;
		$course_module->module = $module_type->id;
		$course_module->course = $section->course;
		$label->course = $section->course;
		$course_module->section = $sectionid;
		if (!update_record("label", $label)) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error updating the label with id=$labelid");
		}
		if (!$course_module_id = add_course_module($course_module)) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error adding course module!");
		}
		$course_module->coursemodule = $course_module_id;
		$course_module->section = $section->section;
		//affect the label to the section
		if (!add_mod_to_section($course_module)) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error adding module to the section!");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_LABEL_TO_SECTION:     Database error: ' . $msg);
		}
		ob_end_clean();
		//make compatible with the return type
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/**
	* Add forum to course section
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $forumid The forum's id
	* @param $groupmode The course modules group mode type. Can be 0 for NOGROUPS 1
	*                   for SEPARATEGROUPS and 2 for VISIBLEGROUPS
	* @param $sectionid The section's id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode) {
		global $CFG;
		require_once ($CFG->dirroot . '/lib/datalib.php');
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey,'affect_forum_to_section')) {
			return $this->error('AFFECT_FORUM_TO_SECTION:     Invalid client connection.');
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.
		ob_start();
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     You do not have proper access to perform this operation");
		}
		// check "groupmode" field
		if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Invalid forum group type $groupmode.");
		}
		//get the forum module
		if (!$module_type = get_record("modules", "name", "forum")) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Module type forum not found!");
		}
		//get the forum record
		if (!($forum = get_record('forum', 'id', $forumid))) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error finding the forum with id=$forumid");
		}
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		//verify if this forum is already assigned to this section
		if ($isAssigned = get_record("course_modules", "module", $module->id, "instance", $forumid))
			return $this->error("AFFECT_FORUM_TO_SECTION:  Forum with ID $forumid is already assigned to section with ID $isAssigned->section");
		//check if this affect already exists
		if (get_record("course_modules", "instance", $forumid, "section", $sectionid)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Forum with id $forumid already contained by section with id $sectionid!");
		}
		$course_module->instance = $forumid;
		$course_module->module = $module_type->id;
		$course_module->course = $section->course;
		$course_module->groupmode = $groupmode;
		$forum->course = $section->course;
		$course_module->section = $sectionid;
		if (!update_record("forum", $forum)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error updating the forum with id=$forumid");
		}
		if (!$course_module_id = add_course_module($course_module)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error adding course module!");
		}
		$course_module->coursemodule = $course_module_id;
		$course_module->section = $section->section;
		//affect the forum to the section
		if (!add_mod_to_section($course_module)) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error adding module to the section!");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_FORUM_TO_SECTION:     Database error: ' . $msg);
		}
		ob_end_clean();
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/**
	* Add section to course
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $sectionid The section's id
	* @param int $courseid The course id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_section_to_course($client, $sesskey, $sectionid, $courseid) {
		global $CFG;
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey,'affect_section_to_course')) {
			return $this->error('AFFECT_SECTION_TO_COURSE:     Invalid client connection.');
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.
		ob_start();
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:update', CONTEXT_SYSTEM, 0)) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     You do not have proper access to perform this operation");
		}
		//get section
		if (!$cur_section = get_record("course_sections", "id", $sectionid)) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     Section with id $sectionid not found.");
		}
		if (!$cur_course = get_record("course", "id", $courseid)) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     Course with id $courseid not found.");
		}
		if ($cur_section->section > $cur_course->numsections) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     Section index $cur_section->section too big. Maximum section number: $cur_course->numsections.");
		}
		//verify if current course has already assigned this section
		if ($duplicate = get_record("course_sections", "course", $courseid, "section", $cur_section->section)) {
			if ($sectionid != $duplicate->id) {
				if (!empty ($duplicate->sequence)) {
					$modarray = explode(",", $duplicate->sequence);
					if (!empty ($cur_section->sequence))
						$modarray2 = explode(",", $cur_section->sequence);
					else
						$modarray2 = array ();
					foreach ($modarray as $key) {
						$module = get_record("course_modules", "id", $key);
						$module->section = $sectionid;
						update_record("course_modules", $module);
						array_push($modarray2, $key);
					}
					$cur_section->sequence = implode(",", $modarray2);
				}
				delete_records("course_sections", "id", $duplicate->id);
			}
		}
		$cur_section->course = $courseid;
		if (!update_record("course_sections", $cur_section)) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     Error updating the section with id=$sectionid");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_SECTION_TO_COURSE:     Database error: ' . $msg);
		}
		ob_end_clean();
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/**
	* Add course to category
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $courseid The course's id
	* @param int $categoryid The category's id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_course_to_category($client, $sesskey, $courseid, $categoryid) {
		global $CFG;
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey,'affect_course_to_category')) {
			return $this->error('AFFECT_COURSE_TO_CATEGORY:     Invalid client connection.');
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.
		ob_start();
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/category:manage', CONTEXT_SYSTEM, 0)) {
			return $this->error("AFFECT_COURSE_TO_CATEGORY:     You do not have proper access to perform this operation");
		}
		/// Check if category with id specified exists
		if (!$destcategory = get_record('course_categories', 'id', $categoryid)) {
			return $this->error("AFFECT_COURSE_TO_CATEGORY:     Error finding the category with id=$categoryid");
		}
		/// Check if course with id specified exists
		if (!$courss = get_record('course', 'id', $courseid)) {
			return $this->error("AFFECT_COURSE_TO_CATEGORY:     Error finding the course with id=$courseid");
		}
		move_courses(array (
			$courseid
		), $categoryid);
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error = 'AFFECT_COURSE_TO_CATEGORY:   Database error: ' . $msg;
		}
		ob_end_clean();
		//make compatible with the return type
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/**
	* Add user to group
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $userid The user's id
	* @param int $groupid The group's id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_user_to_group($client, $sesskey, $userid, $groupid) {

			$this->debug_output('AFFECT_USER_TO_GROUP:     Trying to affect a user to group.');
		if (!$this->validate_client($client, $sesskey,'affect_user_to_group')) {
			return $this->error('AFFECT_USER_TO_GROUP:     Invalid client connection.');
		}
		ob_start();
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
			return $this->error('AFFECT_USER_TO_GROUP:     You do not have proper access to perform this operation.');
		}
		if (!$exist_user = get_record("user", "id", $userid)) {
			return $this->error("AFFECT_USER_TO_GROUP:     userID: " . $userid . ", don't exist in database");
		}
		if (!$exist_user = get_record("groups", "id", $groupid)) {
			return $this->error("AFFECT_USER_TO_GROUP:     groupID: " . $groupid . ", don't exist in database");
		}
		if (!groups_add_member($groupid, $userid)) {
			return $this->error("AFFECT_USER_TO_GROUP:     The group don't exists or the insertion couldn't be made...");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			$msg = trim(ob_get_contents());
			return $this->error = 'AFFECT_USER_TO_GROUP:     Database error: ' . $msg;
			break;
		}
		ob_end_clean();
		$resp = new stdClass();
		$resp->status = true;
		return $resp;
	}
	/**
	* Add  group to course
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $groupid The group's id
	* @param int $courseid The course's id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_group_to_course($client, $sesskey, $groupid, $courseid) {

			$this->debug_output('AFFECT_GROUP_TO_COURSE:     Trying to affect a group to course.');
		if (!$this->validate_client($client, $sesskey,' affect_group_to_course')) {
			return $this->error('AFFECT_GROUP_TO_COURSE:     Invalid client connection.');
		}
		ob_start();
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
			return $this->error('AFFECT_GROUP_TO_COURSE:     You do not have proper access to perform this operation.');
		}
		//verify if this grup exists
		if (!$group = get_record('groups', 'id', $groupid)) {
			return $this->error('AFFECT_GROUP_TO_COURSE:     Group ID was incorrect');
		}
		if (!get_record('course', 'id', $courseid)) {
			return $this->error('AFFECT_GROUP_TO_COURSE:     Course ID was incorrect');
		}
		//verify if this group is assigned of any course
		if ($group->courseid > 0)
			return $this->error("AFFECT_GROUP_TO_COURSE:     This group is already assigned to a course with ID:$group->courseid");
		$group->courseid = $courseid;
		//verify if the update operation is done
		if (!$success = update_record('groups', $group)) {
			return $this->error('AFFECT_GROUP_TO_COURSE:     Update idcourse could not be effectued');
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			$msg = trim(ob_get_contents());
			return $this->error = 'AFFECT_GROUP_TO_COURSE:     Database error: ' . $msg;
			break;
		}
		ob_end_clean();
		$resp = new stdClass();
		$resp->status = true;
		return $resp;
	}
	/**
	* Add wiki to course section
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $wikiid The wiki's id
	* @param int $sectionid The section's id
	* @param int $groupmode The course modules group mode type. Can be 0 for NOGROUPS 1
	*                   for SEPARATEGROUPS and 2 for VISIBLEGROUPS
	* @param int $visible
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible) {

			$this->debug_output('AFFECT_WIKI_TO_SECTION:     Trying to affect a wiki to section.');
		if (!$this->validate_client($client, $sesskey,'affect_wiki_to_section')) {
			return $this->error('AFFECT_WIKI_TO_SECTION:     Invalid client connection.');
		}
		ob_start();
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     You do not have proper access to perform this operation");
		}
		//check if exists in db this id & get wiki record
		if (!$wiki = get_record("wiki", "id", $wikiid)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     WikiId not found in table WIKI ");
		}
		//get the courseId
		if (!$courseSections = get_record("course_sections", "id", $sectionid)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     SectionId not found in table COURSE_SECTIONS ");
		}
		// check "groupmode" field
		if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Group type invalid");
		}
		//get wiki module
		if (!$module = get_record("modules", "name", "wiki")) {
			return $this->error(" AFFECT_WIKI_TO_SECTION:     Wiki module not found");
		}
		//verify if this wiki is already assigned to this section
		if ($isAssigned = get_record("course_modules", "module", $module->id, "instance", $wikiid))
			return $this->error("AFFECT_WIKI_TO_SECTION:  Wiki with ID $wikiid is already assigned to section with ID $isAssigned->section");
		$mod->module = $module->id;
		$mod->instance = $wikiid;
		$mod->course = $courseSections->course;
		if (($groupmode == SEPARATEGROUPS) || ($groupmode == VISIBLEGROUPS)) {
			if ($group = get_record("groups", "courseid", $courseSections->course)) {
				$mod->groupmode = $groupmode;
				$wiki2->groupid = $group->id;
			} else {
				$mod->groupmode = 0;
			}
		}
		$wiki->course = $courseSections->course;
		$mod->visible = $visible;
		//update the wiki
		if (!update_record("wiki", $wiki)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Cannot  update  WIKI table");
		}
		if (!$wiki_entry = get_record("wiki_entries", "wikiid", $wikiid)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:  Wiki with ID $wikiid does not have an entry");
		}
		$wiki2->id = $wiki_entry->id;
		$wiki2->wikiid = $wikiid;
		$wiki2->course = $courseSections->course;
		//update "wiki_entries"
		if (!update_record("wiki_entries", $wiki2)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Impossible to acces WIKI_ENTRIES table");
		}
		$mod->section = $courseSections->section;
		//insert a record in table "course_modules"
		if (!$course_module = add_course_module($mod)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     A module can't be added to table COURSE_MODULE");
		}
		$mod->coursemodule = $course_module;
		if (!set_field("course_modules", "section", $sectionid, "id", $mod->coursemodule)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Impossible to access  COURSE_MODULE");
		}
		//affect the section to the wiki
		if (!$sectionidd = add_mod_to_section($mod)) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Wiki not assigned to section");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_WIKI_TO_SECTION:     Database error: ' . $msg);
		}
		ob_end_clean();
		$res = new stdClass();
		$res->status = true;
		return $res;
	}
	/**
	* Add database to course section
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $databaseid The database's id
	* @param int $sectionid The section's id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_database_to_section($client, $sesskey, $databaseid, $sectionid) {

			$this->debug_output('AFFECT_DATABASE_TO_SECTION:     Trying to affect database to section.');
		if (!$this->validate_client($client, $sesskey,'affect_database_to_section')) {
			return $this->error('AFFECT_DATABASE_TO_SECTION:     Invalid client connection.');
		}
		ob_start();
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_DATABASE_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION:     You do not have proper access to perform this operation");
		}
		//get database module
		if (!$module = get_record("modules", "name", "data")) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: The Module data wasn't found");
		}
		$mod->module = $module->id;
		$mod->instance = $databaseid;
		//get record of database
		if (!$database = get_record("data", "id", $databaseid)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: Invalid databaseID: " . $databaseid . ". This don't exist in database");
		}
		//get the courseId
		if (!$courseSections = get_record("course_sections", "id", $sectionid)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: Invalid sectionID: " . $sectionid . ". This don't exist in database");
		}
		//verify if this database is already assigned to this section
		if ($isAssigned = get_record("course_modules", "module", $module->id, "instance", $databaseid))
			return $this->error("AFFECT_DATABASE_TO_SECTION:  Database with ID $databaseid is already assigned to section with ID $isAssigned->section");
		$mod->course = $courseSections->course;
		$database->course = $mod->course;
		//update the database
		if (!update_record("data", $database)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: The table DATA wasn't updated");
		}
		$mod->section = $courseSections->section;
		//insert a record in table "course_modules"
		if (!$course_module = add_course_module($mod)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: The addition the module to course wasn't effectued");
		}
		$mod->coursemodule = $course_module;
		if (!set_field("course_modules", "section", $sectionid, "id", $mod->coursemodule)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: The field of table course_modules wasn't setted");
		}
		// affect the section to the database
		if (!$sectionidd = add_mod_to_section($mod)) {
			return $this->error("AFFECT_DATABASE_TO_SECTION: The database wasn't assigned to section");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_DATABASE_TO_SECTION: Database error: ' . $msg);
		}
		ob_end_clean();
		$res = new stdClass();
		$res->status = true;
		return $res;
	}
	/**
	* Add assignment to course section
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $assignmentid The assignment's id
	* @param int $sectionid The section's id
	* @param int $groupmode The course modules group mode type. Can be 0 for NOGROUPS 1
	*                   for SEPARATEGROUPS and 2 for VISIBLEGROUPS
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode) {

			$this->debug_output('AFFECT_DATABASE_TO_SECTION:     Trying to affect database to section.');
		if (!$this->validate_client($client, $sesskey,'affect_assignment_to_section')) {
			return $this->error('AFFECT_DATABASE_TO_SECTION:     Invalid client connection.');
		}
		ob_start();
		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION:     You do not have proper access to perform this operation");
		}
		if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: Invalid groupmode");
		}
		//get the assignment record
		if (!$assign = get_record("assignment", "id", $assignmentid)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: Invalid AssignmentID: " . $assignmentid . ", it doesn't exist in database.");
		}
		//get the assignment module
		if (!$module = get_record("modules", "name", "assignment")) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION:  Assignment module can't be found");
		}
		//verify if this assigment is already assigned to this section
		if ($isAssigned = get_record("course_modules", "module", $module->id, "instance", $assignmentid))
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION:  Assignment with ID $assignmentid is already assigned to section with ID $isAssigned->section");
		$mod->module = $module->id;
		$mod->instance = $assignmentid;
		$mod->groupmode = $groupmode;
		//get the courseId
		if (!$courseSections = get_record("course_sections", "id", $sectionid)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: The table Course_Sections {$sectionid} can't be accesed");
		}
		$mod->course = $courseSections->course;
		$assign->course = $courseSections->course;
		//update the assignment
		if (!update_record("assignment", $assign)) {
			return $this->error("The table assignment wasn't updated");
		}
		//is the course already linked to the assignment?
		if ($course_module = get_record("course_modules", "course", $mod->course, "module", $mod->module, "instance", $mod->instance)) {
			$res->status = "true";
			return $res;
		}
		$mod->section = $courseSections->section;
		//affect the course to the assignment
		if (!$course_module = add_course_module($mod)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: The module can't be added to cours");
		}
		$mod->coursemodule = $course_module;
		if (!set_field("course_modules", "section", $sectionid, "id", $mod->coursemodule)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: The fields section and id from course_modules wasn't set");
		}
		// add assignment to the section
		if (!$sectionidd = add_mod_to_section($mod)) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION: Error to function add_mod_to_section");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			$msg = trim(ob_get_contents());
			return $this->error = 'AFFECT_ASSIGNMENT_TO_SECTION: Database error: ' . $msg;
		}
		ob_end_clean();
		$res = new stdClass();
		$res->status = true;
		return $res;
	}
	/**
	* Add a page of wiki to wiki
	* @uses $CFG
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $pageid The page's id
	* @param int $wikiid The wikis' id
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid) {
		global $CFG;
		require_once ($CFG->dirroot . '/mod/wiki/lib.php');
		if (!$this->validate_client($client, $sesskey,'affect_pageWiki_to_wiki')) {
			return $this->error('Invalid client connection.');
		}
		ob_start();
		//we verify if we have the permission to do this operation
		if (!$cm = get_coursemodule_from_instance('wiki', $wikiid)) {
			return $this->error("Course Module ID was not found. We can't verify if you have permission to do this operation");
		}
		if (!$this->has_capabilities($client, $sesskey, 'mod/wiki:participate', CONTEXT_MODULE, $cm->id)) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     You do not have the permission to do this operation.");
		}
		//verify if the wiki exist in the database
		if (!($wiki = get_record("wiki", "id", $wikiid))) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     The wiki does not exist in the database.");
		}
		//we verify if the wiki exist in wiki_entries
		if (!($wiki_entry = get_record("wiki_entries", "wikiid", $wiki->id))) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     The wiki does not exist in wiki_entries");
		}
		//verify if the page of wiki exist in DB
		if (!($page = get_record("wiki_pages", "id", $pageid))) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     The page of wiki does not exist in the database.");
		}
		//verify if the page is not assigned to a wiki
		if ($page->wiki > 0) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     This page of wiki is already assigned to the wiki with ID:$page->wiki");
		}
		//  we find the last version of the first page of wiki
		// it is necessary for viewing  the affected page in wiki
		//at the content of this page we are adding a link to the affected page
		//if this page does not exist  we will create it
		$sql = "SELECT wp.*
		                        FROM {$CFG->prefix}wiki_pages wp
		                        WHERE wp.pagename = '{$wiki->pagename}' AND
		                        wp.wiki = {$wiki_entry->id} AND
		                        wp.version in (select MAX(p.version)
		                        FROM {$CFG->prefix}wiki_pages p
		                        WHERE p.pagename = '{$wiki->pagename}' AND
		                        p.wiki = {$wiki_entry->id}) ";
		// $first_page=get_record_sql($sql);
		if (!$first_page = get_record_sql($sql)) {
			$first_page->pagename = $wiki->pagename;
			$first_page->wiki = $wiki_entry->id;
			$first_page->created = time();
			$first_page->lastmodified = time();
			$first_page->version = 1;
			$first_page->flags = 1;
			$first_page->userid = $this->get_my_id($client, $sesskey);
			;
			if (!($result = insert_record("wiki_pages", $first_page, true))) {
				return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at insertion of the first page of wiki.";
			}
			$first_page = get_record("wiki_pages", "id", $result);
		}
		$res = new stdClass();
		//we verify if our page has the same name as the wiki's pagename
		//in this case our page will became a new version of the first page of wiki
		if ($page->pagename == $first_page->pagename) {
			$page->version = $first_page->version + 1;
			$page->wiki = $wiki_entry->id;
			$page->flags = 1;
			$page->created = time();
			$page->lastmodified = time();
			$page->content = $first_page->content . "<br>" . $page->content;
			if (!update_record("wiki_pages", $page)) {
				return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at update page of wiki.";
			}
			$res->status = true;
			return $res;
		}
		//verify if in database exist another page with the same name assigned to this wiki
		if ($page2 = get_record("wiki_pages", "pagename", $page->pagename, "wiki", $wiki_entry->id)) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     A page of wiki with this name (id=$page2->id)is already assigned to the wiki with ID:$wiki->id");
		}
		$page->wiki = $wiki_entry->id;
		$page->version = 1;
		$page->flags = 1;
		//  update of the page of wiki
		if (!update_record("wiki_pages", $page)) {
			return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at update page of wiki.";
		}
		//create link for the page affected
		$first_page->content = $first_page->content . "<br>[" . $page->pagename . "]";
		if (!update_record("wiki_pages", $first_page)) {
			return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Can not create link to the page new created.";
		}
		if (ob_get_length() && trim(og_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_clean());
			$error = 'AFFECT_PAGEWIKI_TO_WIKI:     Database error: ' . $msg;
		}
		ob_end_clean();
		$res->status = true;
		return $res;
	}
	/**
	* add a user to a course, giving him the role  specified as parameter
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $userid The user's id
	* @param int $courseid The course's id
	* @param string $rolename Specify the name of the role
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename) {
		$this->debug_output("ROLE: " . $rolename);
		if (!$this->validate_client($client, $sesskey,'affect_user_to_course')) {
			return $this->error('AFFECT_USER_TO_COURSE: Invalid client connection.');
		}
		ob_start();
		/// Check for correct course permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/role:assign', CONTEXT_COURSE, $courseid)) {
			return $this->error('AFFECT_USER_TO_COURSE:     You do not have permission to do this operation.');
		}
		$timestart = time();
		$timeend = 0;
		$hidden = 0;
		//if it isn't specified the role name, this will be set as Student
		$rolename = empty ($rolename) ? "Student" : $rolename;
		//verify if the role name specified exist in database
		if (!($role = get_record('role', 'name', $rolename))) {
			return $this->error("AFFECT_USER_TO_COURSE:     The role specified was not implemented!");
		}
		//verify if the user exist in database
		if (!(get_record('user', 'id', $userid))) {
			return $this->error("AFFECT_USER_TO_COURSE:     Error finding the user with id=$userid");
		}
		//verify if the course exist in database
		if (!(get_record('course', 'id', $courseid))) {
			return $this->error("AFFECT_USER_TO_COURSE:     Error finding the course with id=$courseid");
		}
		//add user to course giving him the role specified
		$context = get_context_instance(CONTEXT_COURSE, $courseid);
		if (!role_assign($role->id, $userid, 0, $context->id, $timestart, $timeend, $hidden)) {
			return $this->error("AFFECT_USER_TO_COURSE:     Could not add user with id $userid to this role!");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('AFFECT_USER_TO_COURSE:     Database error: ' . $msg);
		}
		ob_end_clean();
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/**
	* remove a user's role from a course;  the role  specified as parameter
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $userid The user's id
	* @param int $courseid The course's id
	* @param string $rolename Specify the name of the role
	* @return affectRecord Return data (affectRecord object) to be converted into a
	*               specific data format for sending to the client.
	*/
	function remove_userRole_from_course($client, $sesskey, $userid, $courseid, $rolename) {
		if (!$this->validate_client($client, $sesskey,'remove_userRole_from_course')) {
			return $this->error('REMOVE_TEACHER_FROM_COURSE: Invalid client connection.');
		}
		ob_start();
		/// Check for correct course permissions.
		if (!$this->has_capabilities($client, $sesskey, 'moodle/role:assign', CONTEXT_COURSE, $courseid)) {
			return $this->error('REMOVE_USERROLE_FROM_COURSE:     You do not have permission to do this operation.');
		}
		$timestart = 0;
		$timeend = 0;
		$hidden = 0;
		//if it isn't specified the role name, this will be set as Student
		$rolename = empty ($rolename) ? "Student" : $rolename;
		//verify if the role name specified exist in database
		if (!($role = get_record('role', 'name', $rolename))) {
			return $this->error("REMOVE_USERROLE_FROM_COURSE: This role was not implemented!");
		}
		//verify if user exist in database
		if (!(get_record('user', 'id', $userid))) {
			return $this->error("REMOVE_USERROLE_FROM_COURSE: Error finding the user with id=$userid");
		}
		//verify if course exist in database
		if (!(get_record('course', 'id', $courseid))) {
			return $this->error("REMOVE_USERROLE_FROM_COURSE: Error finding the course with id=$courseid");
		}
		//  remove user's role specified from the course
		if (!role_unassign($role->id, $userid, 0, $context->id)) {
			return $this->error("REMOVE_USERROLE_FROM_COURSE: Could not remove user with id $userid from this role!");
		}
		if (ob_get_length() && trim(ob_get_contents())) {
			/// Return an error with  the contents of the output buffer.
			$msg = trim(ob_get_contents());
			return $this->error('REMOVE_USERROLE_FROM_COURSE:     Database error: ' . $msg);
		}
		ob_end_clean();
		$r = new stdClass();
		$r->status = true;
		return $r;
	}
	/*
	*******************************************************************************************
	*                                                                                         *
	*                                    getFunctions                                         *
	*                                                                                         *
	*******************************************************************************************
	*/
	function get_all_wikis($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_wikis')) {
			return $this->error('GET_ALL_WIKIS:    Invalid client connection.');
		}
		$ret = array ();
		if ($res = get_records('wiki', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = $this->filter_wikis($client, $res);
		}
		return $ret;
	}
	function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_pagesWiki')) {
			return $this->error('GET_ALL_PAGESWIKI:    Invalid client connection.');
		}
		$ret = array ();
		if ($res = get_records('wiki_pages', $fieldname, $fieldvalue, 'pagename', '*')) {
			$ret = $this->filter_pagesWiki($client, $res);
		}
		return $ret;
	}
	function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_groups')) {
			return $this->error('GET_ALL_GROUPS:    Invalid client connection.');
		}
		$ret = array ();
		if ($res = get_records('groups', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = $this->filter_groups($client, $res);
		}
		return $ret;
	}
	function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_forums')) {
			return $this->error('GET_ALL_FORUMS:    Invalid client connection.');
		}
		$ret = array ();
		if ($forums = get_records("forum", $fieldname, $fieldvalue, "name")) {
			$ret = $this->filter_forums($client, $forums);
		}
		return $ret;
	}
	function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_labels')) {
			return $this->error('GET_ALL_LABELS:    Invalid client connection.');
		}
		$ret = array ();
		if ($labels = get_records("label", $fieldname, $fieldvalue, "name")) {
			$ret = $this->filter_labels($client, $labels);
		}
		return $ret;
	}
	function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_assignments')) {
			return $this->error('GET_ALL_ASSIGNMENTS:    Invalid client connection.');
		}
		$ret = array ();
		if ($assignments = get_records("assignment", $fieldname, $fieldvalue, "name")) {
			$ret = $this->filter_assignments($client, $assignments);
		}
		return $ret;
	}
	function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey,'get_all_databases')) {
			return $this->error('GET_ALL_DATABASES:     Invalid client connection.');
		}
		$ret = array ();
		if ($databases = get_records("data", $fieldname, $fieldvalue, "name")) {
			$ret = $this->filter_databases($client, $databases);
		}
		return $ret;
	}
	function filter_wiki($client, $wiki) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $wiki;
	}
	function filter_wikis($client, $wikis) {
		$res = array ();
		foreach ($wikis as $wiki) {
			$wiki = $this->filter_wiki($client, $wiki);
			if ($wiki) {
				$res[] = $wiki;
			}
		}
		return $res;
	}
	function filter_pagewiki($client, $pagewiki) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $pagewiki;
	}
	function filter_pagesWiki($client, $pagesWiki) {
		$res = array ();
		foreach ($pagesWiki as $pagewiki) {
			$pagewiki = $this->filter_pagewiki($client, $pagewiki);
			if ($pagewiki) {
				$res[] = $pagewiki;
			}
		}
		return $res;
	}
	function filter_forum($client, $forum) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $forum;
	}
	function filter_forums($client, $forums) {
		$res = array ();
		foreach ($forums as $forum) {
			$forum = $this->filter_forum($client, $forum);
			if ($forum) {
				$res[] = $forum;
			}
		}
		return $res;
	}
	function filter_assignment($client, $assignment) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $assignment;
	}
	function filter_assignments($client, $assignments) {
		$res = array ();
		foreach ($assignments as $assignment) {
			$assignment = $this->filter_assignment($client, $assignment);
			if ($assignment) {
				$res[] = $assignment;
			}
		}
		return $res;
	}
	function filter_database($client, $database) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $database;
	}
	function filter_databases($client, $databases) {
		$res = array ();
		foreach ($databases as $database) {
			$database = $this->filter_database($client, $database);
			if ($database) {
				$res[] = $database;
			}
		}
		return $res;
	}
	function filter_label($client, $label) {
		//todo return only those where user is teacher
		//$uid = $this->get_session_user($client);
		return $label;
	}
	function filter_labels($client, $labels) {
		$res = array ();
		foreach ($labels as $label) {
			$label = $this->filter_label($client, $label);
			if ($label) {
				$res[] = $label;
			}
		}
		return $res;
	}
	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 END LILLE FUNCTIONS                                                       *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/
	/**
	* these function mask attributes or remove records depending of logged-in user rights
	*/
	function filter_user($client, $user, $role) {
		/**   COMMENTED OUT TO ALOW UNDELETE ati OPERTAION
		if (isset($user->deleted) && $user->deleted)
			return false;
		*/
		if ($user->emailstop)
			$user->email = "not disclosed by user's will";
		$user->password = ''; //no way, even in  md5, can be cracked by reverse dictionnary
		$user->role = $role; // add a basic role info if available (see get_users_bycourse)
		return $user;
	}
	function filter_users($client, $users, $role) {
		$res = array ();
		foreach ($users as $user) {
			$user = $this->filter_user($client, $user, $role);
			if ($user)
				$res[] = $user;
		}
		return $res;
	}
	function filter_course($client, $course) {
		//return false if not visible to $client
		$cuid = $this->get_session_user($client);
		if ($this->isteacher($course->id, $cuid)) //rev 1.5.14 include admin (cf Florent Carlier)
			return $course;
		$course->password = ''; // do not disclose it to non teacher
		// question : is course's category is not visible, should we hide it ?
		if (!$this->using17)
			return ($course->visible ? $course : false); //wrong if called by get_my_courses
		else {
			// check capability , course maybe non visible
			$context = get_context_instance(CONTEXT_COURSE, $course->id);
			if (has_capability('moodle/course:view', $context, $cuid, false))
				return $course;
			else
				return false;

		}
	}
	function filter_courses($client, $courses) {
		$res = array ();
		foreach ($courses as $course) {
			$course = $this->filter_course($client, $course);
			if ($course)
				$res[] = $course;
		}
		return $res;
	}
	function filter_category($client, $category) {
		//return false if not visible to $client
		$uid = $this->get_session_user($client);
		if ($this->isadmin($uid))
			return $category;
		return $category->visible ? $category : false;
	}
	function filter_categories($client, $categories) {
		$res = array ();
		foreach ($categories as $category) {
			$category = $this->filter_category($client, $category);
			if ($category)
				$res[] = $category;
		}
		return $res;
	}
	function filter_group($client, $group) {
		//todo return false if not visible to $client
		// check user's membership to this group ?
		$cuid = $this->get_session_user($client);
		if (!$this->isteacher($group->courseid, $cuid)) {
			$group->enrolmentkey = '';
		}
		$group->password = '';
		return $group;
	}
	function filter_groups($client, $groups) {
		$res = array ();
		foreach ($groups as $group) {
			$group = $this->filter_group($client, $group);
			if ($group)
				$res[] = $group;
		}
		return $res;
	}
	function filter_resource($client, $resource) {
		if (isset ($resource->error) && $resource->error)
			return $resource;
		$resource->timemodified_ut = userdate($resource->timemodified);
		//return false if resource->visible is false AND $client not "teacher"
		$cuid = $this->get_session_user($client);
		if ($this->isteacher($resource->course, $cuid))
			return $resource;
		return $resource->visible ? $resource : false;
	}
	function filter_resources($client, $resources) {
		$res = array ();
		foreach ($resources as $resource) {
			$resource = $this->filter_resource($client, $resource);
			if ($resource)
				$res[] = $resource;
		}
		return $res;
	}
	function filter_section($client, $section) {
		if (isset ($section->error) && $section->error)
			return $section;
		//return false if section->visible is false AND $client not "teacher"
		$cuid = $this->get_session_user($client);
		if ($this->isteacher($section->course, $cuid))
			return $section;
		return $section->visible ? $section : false;
	}
	function filter_sections($client, $sections) {
		$res = array ();
		foreach ($sections as $section) {
			$section = $this->filter_section($client, $section);
			if ($section)
				$res[] = $section;
		}
		return $res;
	}
	function filter_activity($client, $activity) {
		//add attributes with all timestamps converted to friendly dates
		//using moodlelib function userdate .
		/*  some problems with a french Moodle and accentuaed month names
		            theya re returned in latin1 and not utF8 --> SOAP conversion error
		        $activity->DATE=userdate($activity->time);
		$activity->DLA=userdate($activity->lastaccess);
			$activity->DFA=userdate($activity->firstaccess);
		$activity->DLL=userdate($activity->lastlogin);
		$activity->DCL=userdate($activity->currentlogin);
		        */
		return $activity;
	}
	function filter_activities($client, $activities) {
		$res = array ();
		foreach ($activities as $activity) {
			$activity = $this->filter_activity($client, $activity);
			if ($activity)
				$res[] = $activity;
		}
		//$this->debug_output(print_r($res,true));
		return $res;
	}


/**
 * remove empty grades and fix null feedbacks
 */
    function filter_grade($client, $grade) {
        if (!empty($grade->error)) return $grade;
        if (empty($grade->grade)) return false;
        if (empty($grade->feedback)) $grade->feedback="";
        return $grade;
    }
    function filter_grades($client,$grades) {
        $res = array ();
        foreach ($grades as $grade) {
            $grade = $this->filter_grade($client, $grade);
            if ($grade) {
                $res[] = $grade;
            }
        }
        return $res;
    }

function filter_change($client, $change) {
        //return false if ressource changed is not visible to $client
        $uid = $this->get_session_user($client);
        if ($this->isteacher($change->courseid, $uid))
            return $change;
        return $change->visible ? $change : false;
    }

	function filter_changes($client, $changes) {
		$res = array ();
		foreach ($changes as $change) {
			$change = $this->filter_change($client, $change);
			if ($change)
				$res[] = $change;
		}
		return $res;
	}
	function filter_event($client, $eventype, $event) {
		$uid = $this->get_session_user($client);
		if ($this->isadmin($uid))
			return $event;
		switch ($eventype) {
			case cal_show_user :
				if ($event->userid != uid)
					return false;
				else {
					return $event;
				}
				break;
			case cal_show_group :
				if (!ismember($event->groupeid, $uid))
					return false;
				else
					return $event;
				break;
			case cal_show_course :
				//TODO check course rights and visibility
				return $event;
				break;
			default :
				return $event;
		}
	}
	//PP END
}
?>
