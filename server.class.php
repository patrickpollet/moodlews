<?php // $Id: server.class.php,v 1.5.4 2007/05/02 04:05:36 ppollet Exp $

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

require_once('../config.php');

/// increase memory limit (PHP 5.2 does different calculation, we need more memory now)
// j'ai 11000 comptes

@raise_memory_limit("192M");  //fonction de lib/setuplib.php incluse via config.php
set_time_limit(0);


//define('DEBUG', true);  rev. 1.5.16 already set (or not) in  MoodleWS.php 
define ('cal_show_global',1);
define ('cal_show_course',2);
define ('cal_show_groups', 4);
define ('cal_show_user',8);


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

//        var $version        = 2006050800;  //initial version up to rel. 1.5.4
          var $version        = 2007051000;  // added ip in mdl_webservice_sessions 

        var $sessiontimeout = 1800;  // 30 minutes.
        var $using17;
        var $using19=false;

    /**
     * Constructor method.
     * 
     * @uses $CFG
     * @param none
     * @return none
     */
        function server() {
            global $CFG;

            if (DEBUG) $this->debug_output("Server init...");

            $this->using17 = file_exists($CFG->libdir . '/accesslib.php');
 	    $this->using19 = file_exists($CFG->libdir . '/grouplib.php');
        /// Check for any upgrades.
            if (empty($CFG->webservices_version)) {
                $this->upgrade(0);
            } else if ($CFG->webservices_version < $this->version) {
                $this->upgrade($CFG->webservices_version);
            }
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

            if (DEBUG) $this->debug_output('Starting WS upgrade to version ' . $oldversion);

            ob_start();

            $return = true;

            if ($this->using17){
                require_once($CFG->libdir . '/ddllib.php');
                if($oldversion <2006050800) {
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
                    } else if ($CFG->dbtype == 'postgres7') {
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

                if (DEBUG) $this->debug_output('Upgraded from ' . $oldversion . ' to ' . $this->version);
            } else {
                if (DEBUG) $this->debug_output('ERROR: Could not upgrade to version ' . $this->version);
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
            if (DEBUG) $this->debug_output('Running INIT for client: ' . $client);

       /// Add this client's database record.
            if (!$sess = get_record('webservices_sessions', 'id', $client)) {
                if (DEBUG) $this->debug_output('No session');
                return $this->error('Could not get validated client session (' . $client . ').');
            } 

            $sess->sessionbegin = time();
            $sess->sessionend   = 0;
            $sess->sessionkey   = $this->add_session_key();
 
            if (!update_record('webservices_sessions', $sess)) {
                if (DEBUG) $this->debug_output('No update');
                return $this->error('Could not initialize client session (' . $client . ').');
            }

            if (DEBUG) {
                $this->debug_output('Login successful.');
            }

        /// Return standard data to be converted into the appropriate data format
        /// for return to the client.
            $ret= array(
                'client'     => $client,
                'sessionkey' => $sess->sessionkey
            );
            $this->debug_output(print_r($ret,true));
            return $ret;
        }


    /**
     * Creates a new session key.
     * 
     * @param none
     * @return string A 32 character session key.
     */
        function add_session_key() {
            $time    = (string)time();
            $randstr = (string)random_string(10);

        /// XOR the current time and a random string.
            $str  = $time;
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
            if (!$sess = get_record('webservices_sessions', 'id', $client,
                                    'sessionend', 0, 'verified', 1)) {
                if (DEBUG) $this->debug_output('No session exists for client: ' . $client);
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
            if (!$sess = get_record('webservices_sessions', 'id', $client,
                                    'sessionend', 0, 'verified', 1)) {
                if (DEBUG) $this->debug_output('No session exists for client: ' . $client);
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
        function validate_client($client = 0, $sesskey = '') {
		global $USER;
	    /// We can't validate a session that hasn't even been initialized yet.
            if (!$sess = get_record('webservices_sessions', 'id', $client,
                               'sessionend', 0, 'verified', 1)) {
                return false;
            }

        /// Validate this session.
            if ($sesskey != $sess->sessionkey) {
                return false;
            }
	   // rev 1.5.14 otherwise get_my_courses does not show hidden courses in 1.9 !
           // bug breaks everything in Moodle 1.7 ($this->isadmin fails !) 
           if ($this->using19) {
               $USER->id=$sess->userid;
               unset($USER->access); // important for get_my_courses !
               if(DEBUG) $this->debug_output("validate_client OK $client user=".print_r($USER,true));
            }
            return true;
        }


    /**
     * Validates a client session to determine whether it has expired or not.
     * NOT CALLED in 1.4 ???
     * @param int $client The client session record ID.
     * @param object $request The request object from the client.
     * @return boolean True if session is valid, False otherwise.
     */
        function validate_session($client, $request) {
            if (!$sess = get_record('webservices_sessions', 'id', $client)) {
                return false;
            }
            
            if ($sess->sessionkey != $request->get_sessionkey()) {
                if (DEBUG) $this->debug_output('Invalid session key for client (' . $client . ').');
            }
           
            if ((time() - $sess->sessionbegin) > $this->sessiontimeout) {
                if (DEBUG) $this->debug_output('Session (' . $client . ') expired.');
                return false;
            }
            
            return true;
        }


    /**
     * Validate's a client's request.
     * NOT USED ???
     * @param object $request The request object from the client.
     * @return boolean True if the request is valid, False otherwise. 
     */
        function validate_request($request) {
            return $request->validate();
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

        /// Use Moodle authentication.
        /// FIRST make sure user exists , otherwise account WILL be created with CAS authentification ....
	    if (! $knowuser=get_record('user','username',$username)) {
                return $this->error('Invalid username and / or password.');
	    }
        /// also make sure internal_authentication is used  (a limitation to fix ...)
           if (! is_internal_auth($knowuser->auth)) {
                return $this->error('Invalid username and / or password.');  
            }
            $user = authenticate_user_login($username, $password);
            // $this->debug_output('return of a_u_l'. print_r($user,true));
            if (($user === false) || ($user && $user->id==0)) {
                return $this->error('Invalid username and / or password.');
            } else {
            /// Verify that an active session does not already exist for this user.
                $sql = "SELECT s.*
                        FROM {$CFG->prefix}webservices_sessions s
                        WHERE s.userid = {$user->id} AND
                              s.verified = 1 AND
                              s.sessionend != 0 AND
                              (" . time() . " - s.sessionbegin) < " . $this->sessiontimeout ;
                
                if (record_exists_sql($sql)) {
                    return $this->error('A session already exists for this user (' . $user->id . ')');
                }

            /// Login valid, create a new session record for this client.
                $sess = new stdClass;
                $sess->userid   = $user->id;
                $sess->verified = true;
		$sess->ip=getremoteaddr(); // rev 1.5.4 
                $sess->id = insert_record('webservices_sessions', $sess);

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

            if ($sess = get_record('webservices_sessions', 'id', $client,
                                   'sessionend', 0, 'verified', 1)) {
               // $sess->userid   = 0;  why ? we should keep track of who came to see us ?  
                $sess->verified = 0;

                if (update_record('webservices_sessions', $sess)) {
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
            if ($sess = get_record('webservices_sessions', 'id', $client,
                                   'sessionend', 0, 'verified', 0)) {
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

            if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

        /// Verify that the user for this session can perform this operation.
            $uid = $this->get_session_user($client);

            if (!$this->isadmin($uid)) {
                return $this->error('You do not have proper access to perform this operation.');
            }

            $rusers = array();
            if (DEBUG) $this->debug_output('Attempting to update user IDS: ' . print_r($users,true));
            if (!empty($users)) {
                foreach ($users->users as $user) {
                    $ruser = new stdClass;
                    if (DEBUG) $this->debug_output('traitement de '.print_r($user,true));  
                    switch ($user->action) {
                        case 'Add':
                            $useradd = $user;
                            unset($useradd->action);
                            if (DEBUG) $this->debug_output('adding' . print_r($useradd,true));

                            //Moodle 1.8 and later (a required field that must be non 0 for login )
                            if ($CFG->mnet_localhost_id) 
				if (!$useradd->mnethostid) //if not set by caller (TODO add to userdatum record)
                            	   $useradd->mnethostid = $CFG->mnet_localhost_id; // always local user



                        /// This database operation MIGHT throw an HTML error message,
                        /// so we've got to catch that and send it back in an error
                        /// request.
                            ob_start();

                            if (!isset($useradd->confirmed) || empty($useradd->confirmed)) {
                                $useradd->confirmed = true;
                            }
                            $useradd->id = insert_record('user', $useradd);
                            if (DEBUG) $this->debug_output('ID is '.$useradd->id); 
                            if (ob_get_length() && trim(ob_get_contents())) {
                            /// Return an error with  the contents of the output buffer.
                                $msg = trim(ob_get_clean());
                                return $this->error('Database error: ' . $msg);
                            }
                            ob_end_clean();
                            
                            if (empty($useradd->id)) {
                                $ruser->error = 'Could not add user: ' . fullname($useradd);
                            } else {
                                $ruser = get_record('user', 'id', $useradd->id);
                            }

                            break;

                        case 'Update':
                            $userup = $user;
                            $uid    = $userup->idnumber;
                            $dbfail = false;
                            unset($userup->action);

                            if (DEBUG) $this->debug_output('Attempting to update user ID: ' . $uid);

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
                                $dbfail       = true;
                            }
                            ob_end_clean();

                            if (!$dbfail && empty($user)) {
                                $ruser = $user;
                                $ruser->error = 'Could not find user ID: ' . $uid;
                            } else {
                            /// Update values in the $user database record with what
                            /// the client supplied.
                                foreach ($userup as $key=>$value)
					if (!empty($value))  // rev 1.5.15 must ignore empty values ! serious flaw !
                                    		$user->$key=$value;                               
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
                                    $dbfail       = true;
                                }
                                ob_end_clean();
                                
                                if (!$dbfail && !$success) {
                                    $ruser = $user;
                                    $ruser->error = 'Could not update user: ' . $uid;
                                } else if (!$dbfail && $success){
                                    $ruser = get_record('user', 'id', $user->id);
                                }
                            }

                            break;

                        case 'Delete':
                            $uid    = $user->idnumber;
                            $dbfail = false;

                        /// Deleting an existing user.
                            if (DEBUG) $this->debug_output('Attempting to delete user ID: ' . $uid);
                            
                        /// This database operation MIGHT throw an HTML error message,
                        /// so we've got to catch that and send it back in an error
                        /// request.
                            ob_start();

                            $user = get_record('user', 'idnumber', $uid);

                            if (ob_get_length() && trim(ob_get_contents())) {
                            /// Return an error with  the contents of the output buffer.
                                $msg = trim(ob_get_clean());
                                
                                $ruser->error = 'Database error: ' . $msg;
                                $dbfail       = true;
                            }
                            ob_end_clean();

                            if (!$dbfail && empty($user)) {
                                $ruser->error = 'Could not find user ID: ' . $uid;
                            } else {
                            /// 'Delete' the user the Moodle way.
                                $updateuser = new stdClass;
                                $updateuser->id = $user->id;
                                $updateuser->deleted = "1";
                                $updateuser->username = "$user->email.".time();  // Remember it just in case
                                $updateuser->email = "";                         // Clear this field to free it up
                                $updateuser->idnumber = "";                      // Clear this field to free it up
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
                                    $dbfail       = true;
                                }
                                ob_end_clean();
                                
                                if (!$dbfail && $success) {
                                    if ($this->using17) {
                                        delete_records('role_assignments', 'userid', $user->id);
                                    } else {
                                        unenrol_student($user->id);  // From all courses
                                        remove_teacher($user->id);   // From all courses
                                        remove_admin($user->id);
                                    }
                                    
                                    $ruser = get_record('user', 'id', $user->id);
                                } else if ($dbfail || !$success){
                                    $ruser        = $user;
                                    $ruser->error = 'Could not delete user ID: ' . $uid;
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
            if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

        /// Verify that the user for this session can perform this operation.
            $uid = $this->get_session_user($client);

            if (!$this->isteacherinanycourse($uid)) {
                return $this->error('You do not have proper access to perform this operation.');
            }
            
            $ret = array();  // Return array.

            if (empty($userids)) { // all users ...
		return $this->filter_users($client,get_users(true),0);
            }
            foreach ($userids as $userid) {
                $error = '';

            /// This database operation MIGHT throw an HTML error message,
            /// so we've got to catch that and send it back in an error
            /// request.
                ob_start();

                $users = get_records('user', $idfield, $userid);

                if (ob_get_length() && trim(og_get_contents())) {
                /// Return an error with  the contents of the output buffer.
                    $msg = trim(ob_get_clean());

                    $error = 'Database error: ' . $msg;
                }
                ob_end_clean();

                if (!empty($error)) {
                    $this->debug_output(' DB error'. $msg);
                    return $this->error($error);
                }

                if (empty($users)) {
                    $ret[]=$this->non_fatal_error ("no match found for $idfield= $userid");
                } else {
			$users=$this->filter_users($client,$users,0);
			foreach($users as $user)
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

            if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid  = $this->get_session_user($client);
            $site = get_site();
            $ret  = array();

            if (!empty($courses)) {
                foreach ($courses->courses as $course) {
                    $rcourse = new stdClass;
                    switch ($course->action) {
                        case 'Add':
                        /// Adding a new course.
                            $courseadd = $course;

                            if (DEBUG) $this->debug_output('Trying to add a new course.');

                        /// Check for correct permissions.
                            if (!$this->iscreator($uid)) {
                                if (DEBUG) $this->debug_output('Invalid access UID: ' . $uid);
                                $rcourse->error = 'You do not have proper access to perform this operation.';

                            } else if (record_exists('course', 'idnumber', $courseadd->idnumber)) {
                                $rcourse->error = 'A course with this ID number already exists: ' .
                                                  $courseadd->idnumber;

                            } else {
                            /// These database operations MIGHT throw an HTML error message,
                            /// so we've got to catch that and send it back in an error
                            /// request.
                                ob_start();
    
                                // place at beginning of category
                                fix_course_sortorder();
                                $courseadd->sortorder = get_field_sql("SELECT min(sortorder)-1 FROM " .
                                    "{$CFG->prefix}course WHERE category=$courseadd->category");                
                                if (empty($courseadd->sortorder)) {
                                    $courseadd->sortorder = 100;
                                }
    
                                if (!isset($courseadd->maxbytes)) {
                                    $byteschoices = get_max_upload_sizes($CFG->maxbytes);
                                    $courseadd->maxbytes = key($byteschoices);
                                }
    
                                if (!isset($courseadd->startdate)) {
                                    $courseadd->startdate = time();
                                }
    
                                $courseadd->timecreated  = time();
                                $courseadd->timemodified = time();
    
                                $courseadd->id = insert_record('course', $courseadd);
    
                                if (ob_get_length() && trim(ob_get_contents())) {
                                /// Return an error with  the contents of the output buffer.
                                    $msg            = trim(ob_get_contents());
                                    $rcourse->error = 'Database error: ' . $msg;
                                }
                                ob_end_clean();
                                
                                if (empty($courseadd->id)) {
                                    $rcourse->error = 'Could not add course: ' .
                                                        $courseadd->shortname;
                                } else {
                                    require_once($CFG->libdir . '/pagelib.php');
                                    require_once($CFG->libdir . '/blocklib.php');
    
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
                                        $msg            = trim(ob_get_clean());
                                        $rcourse->error = 'Database error: ' . $msg;
                                    }
                                    ob_end_clean();
    
                                    $rcourse = get_record('course', 'id', $courseadd->id);
                                }
                            }

                            break;

                        case 'Update':
                        /// Updating an existing course.
                            $courseup = $course;
                            $cid      = $courseup->idnumber;
                            $dbfail   = false;
                            
                            if (DEBUG) $this->debug_output('Attempting to update course ID: ' . $cid.print_r($course,true));
                            
                        /// This database operation MIGHT throw an HTML error message,
                        /// so we've got to catch that and send it back in an error
                        /// request.
                            ob_start();

                            $course = get_record('course', 'idnumber', $cid);

                            if (ob_get_length() && trim(ob_get_contents())) {
                            /// Return an error with  the contents of the output buffer.
                                if (DEBUG) $this->debug_output('E_DB: "' . ob_get_contents() . '"');
                                $msg            = trim(ob_get_clean());
                                $rcourse->error = 'Database error: ' . $msg;
                                $dbfail         = true;
                            }
                            ob_end_clean();

                        /// Check for correct permissions.
                            if (!$dbfail && empty($course)) {
                                $rcourse->error = 'Could not find course ID: ' . $cid;

                            } else if (!$dbfail && !$this->isteacher($course->id, $uid)) {
                                $rcourse->error  = 'You do not have proper access to perform this operation.';

                            } else if (!$dbfail){
                            /// Update values in the course database record with what
                            /// the client supplied.
                               foreach($courseup as $key=>$value)
					if (!empty($value))   // rev 1.5.15 must ignore empty values ! serious flaw !
                                    		$course->$key = $value;
                                 $course->timemodified = time();
                                ob_start();
                                
                                $success = update_record('course', $course);
                                
                                if (ob_get_length() && trim(ob_get_contents())) {
                                    $msg            = trim(ob_get_clean());
                                    $rcourse->error = 'Database error: ' . $msg;
                                    $dbfail         = true;
                                }
                                ob_end_clean();
                                
                                if (!$dbfail && !$success) {
                                    $rcourse->error = 'Could not update course: ' . $cid;
                                } else if (!$dbfail && $success) {
                                    $rcourse = get_record('course', 'id', $course->id);
                                }
                            }

                            break;

                        case 'Delete':
                        /// Deleting an existing course.
                            $cid    = $course->idnumber;
                            $dbfail = false;

                        /// Check for correct permissions.
                            if (!$this->isadmin($uid)) {
                                $rcourse->error = 'You do not have proper access to ' .
                                                  'perform this operation.';
                            } else {
                                if (DEBUG) $this->debug_output('Attempting to delete course ID: ' . $cid);
                                
                            /// This database operation MIGHT throw an HTML error message,
                            /// so we've got to catch that and send it back in an error
                            /// request.
                                ob_start();
    
                                $course = get_record('course', 'idnumber', $cid);
    
                                if (ob_get_length() && trim(ob_get_contents())) {
                                /// Return an error with  the contents of the output buffer.
                                    $msg            = trim(ob_get_clean());
                                    $rcourse->error = 'Database error: ' . $msg;
                                    $dbfail         = true;
                                }
                                ob_end_clean();
    
                                if (!$dbfail && empty($course)) {
                                    $rcourse->error = 'Could not find course ID: ' . $cid;

                                } else if (!$dbfail) {
                                /// 'Delete' the course the Moodle way.
                                    $success_r = true;
                                    $success_d = true;
                                    $success_f = true;
                                    
                                /// These operations MIGHT throw an HTML error message,
                                /// so we've got to catch that and send it back in an error
                                /// request.
                                    ob_start();
    
                                    require_once($CFG->libdir . '/moodlelib.php');
                                    $success_r = remove_course_contents($course->id, false);
                                    
                                    if (ob_get_length() && trim(ob_get_contents())) {
                                    /// Return an error with  the contents of the output buffer.
                                        $msg  = trim(ob_get_clean());
                                        $rcourse->error = 'API call error: ' . $msg;
                                    }
                                
                                    if ($success_r && !isset($rcourse->error)) {
                                        $success_d = delete_records('course', 'id', $course->id);
                                    } 
                                
                                    if (ob_get_length() && trim(ob_get_contents())) {
                                    /// Return an error with a E_DB status set and the
                                    /// contents of the output buffer.
                                        $msg = trim(ob_get_clean());
                                        $rcourse->error('Database error.', WS_STAT_E_DB, $msg);
                                    }
                                
                                    if ($success_r && $success_d && !isset($rcourse->error) &&
                                        ($dir = @opendir($CFG->dataroot . '/' . $course->id))) {
                                        closedir($dir);
                                        require_once($CFG->libdir . '/filelib.php');
                                        $success_f = fulldelete($CFG->dataroot . '/' . $course->id);
                                    }
    
                                    if (ob_get_length() && trim(ob_get_contents())) {
                                    /// Return an error with  the contents of the output buffer.
                                        $msg = trim(ob_get_clean());
                                        return $this->error('API call error (2).', WS_STAT_E_API, $msg);
                                    }
    
                                    ob_end_clean();

                                    if (!isset($rcourse->error)) {
                                        if (!$success_r) {
                                            $rcourse->error = 'Error deleting some of the course contents (' .
                                                              $cid . ').';
                                        } else if (!$success_d) {
                                            $rcourse->error = 'Error deleting the course record (' . $cid . ').';
                                        } else if (!$success_f) {
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
            if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid = $this->get_session_user($client);                
            $ret = array();

	    if (empty($courseids)) {
		// all courses wanted
		//we cannot use datalib/get_courses that filter off courses against $USER
		// that is not (yet) set here
		$res=get_records('course','','');
		return $this->filter_courses($client,$res); 
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
                    $ret[]=$this->error('Database error: ' . $msg);
                }
                ob_end_clean();

                if (!empty($courses)) {
                	$courses=$this->filter_courses($client,$courses);
			foreach ($courses as $course)
				$ret[]=$course;
                } else {
                	$ret[]=$this->non_fatal_error("no match for $idfield = $courseid");
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
     public function get_resources($client, $sesskey, $courseids,$idfield='idnumber') {
	  global $CFG;
	  if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid = $this->get_session_user($client);
            $ret = array();

            if (empty($courseids)) {
                // all resources from all courses wanted
                //we cannot use datalib/get_courses that filter off courses against $USER
                // that is not (yet) set here
                $courses=get_records('course','','');
            } else {
		$courses=array();
		foreach($courseids as $courseid) {
		   if ($course = get_record('course', $idfield, $courseid)) 
                	$courses[]=$course;	
                   else {  
			//append an error record to the list 
 			$tmp->error = 'Could not find course with ' .$idfield.'='.$courseid;
			$ret[]=$tmp;                    
                   }    
                }
            }

	    //remove courses not available to current user
            $courses= $this->filter_courses($client,$courses);
	    $ilink="{$CFG->wwwroot}/mod/resource/view.php?id=";
            foreach ($courses as $course) {
		if ($resources = get_all_instances_in_course("resource", $course,NULL,true)) {
            		foreach ($resources as $resource) {
                        	$resource->url=$ilink.$resource->coursemodule;
				$ret[]=$resource;
                	}
		}
	    }
            return $this->filter_resources($client,$ret);
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
     public function get_sections($client, $sesskey, $courseids,$idfield='idnumber') {
	  global $CFG;
	  if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid = $this->get_session_user($client);
            $ret = array();
            $this->debug_output('get_sections '. print_r($courseids,true));

	
            if (!empty($courseids) && ! is_array($courseids)) {
	       $courseids=array($courseids);
            }
            $this->debug_output('get_sections II'. print_r($courseids,true));

            if (empty($courseids)) {
                // all resources from all courses wanted
                //we cannot use datalib/get_courses that filter off courses against $USER
                // that is not (yet) set here
                $courses=get_records('course','','');
            } else {
		$courses=array();
		foreach($courseids as $courseid) {
		   if ($course = get_record('course', $idfield, $courseid)) 
                	$courses[]=$course;	
                   else {  
			//append an error record to the list 
 			$tmp->error = 'Could not find course with ' .$idfield.'='.$courseid;
			$ret[]=$tmp;                    
                   }    
                }
            }

	    //remove courses not available to current user
            $courses= $this->filter_courses($client,$courses);
            foreach ($courses as $course) {
		if ($resources = get_all_sections($course->id))
			foreach ($resources as $resource) {
				$ret[]=$resource;
                }
	    }
            return $this->filter_sections($client,$ret);
        }


	public function get_instances_bytype($client, $sesskey, $courseids,$idfield='idnumber',$type) {
        //TODO merge with get_resources by giving $type="resource" 
          global $CFG;
          if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid = $this->get_session_user($client);
            $ret = array();

            if (empty($courseids)) {
                // all resources from all courses wanted
                //we cannot use datalib/get_courses that filter off courses against $USER
                // that is not (yet) set here
                $courses=get_records('course','','');
            } else {
                $courses=array();
                foreach($courseids as $courseid) {
                   if ($course = get_record('course', $idfield, $courseid))
                        $courses[]=$course;
                   else {
                        //append an error record to the list
                        $tmp->error = 'Could not find course with ' .$idfield.'='.$courseid;
                        $ret[]=$tmp;
                   }
                }
            }

           //remove courses not available to current user
            $courses= $this->filter_courses($client,$courses);
            foreach ($courses as $course) {
                $resources = get_all_instances_in_course($type, $course,NULL,true);
                $ilink="{$CFG->wwwroot}/mod/$type/view.php?id=";
                foreach ($resources as $resource) {
                        $resource->url=$ilink.$resource->coursemodule;
                        $ret[]=$resource;
                }
            }
            return $this->filter_resources($client,$ret);
        }



    /**
     * Find and return a list of student grade values.
     * 
     * @uses $CFG
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userid The user ID number of the student.
     * @param array $courseids An array of input course idnumber values.
     * @param string $idfield : attribute used to identity courses.
     *      note that $userid is ALWAYS a student idnumber, not a Moodle id. 
     * @return array Return data (student grade information) to be converted
     *               into a specific data format for sending to the client.
     */
        function get_grades($client, $sesskey, $userid, $courseids, $idfield = 'idnumber') {
            global $CFG;

            if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
            }

            $uid = $this->get_session_user($client);

            if (!$user = get_record('user', 'idnumber', $userid)) {
                return $this->error('Could not find user record (' . $userid. ').');
            }

            require_once($CFG->dirroot . '/grade/lib.php');

            $return = array();

        /// Find grade data for the requested IDs.
            foreach ($courseids as $cid) {
                $rgrade = new stdClass;
                $rgrade->error    = '';
                $rgrade->courseid = $cid;

            /// Get the student grades for each course requested.
                if ($course = get_record('course', $idfield, $cid)) {
			  if ($this->isteacher($course->id,$uid)) {

		                /// The grade functions require the course record object to be global.
                		$GLOBALS['course'] = $course;
		                    $success     = false;
                		    $group       = get_current_group($course->id);
                   		 $preferences = grade_get_preferences($course->id);
                	
                    		list($grades_by_student, $all_categories) = grade_get_formatted_grades();

                		/// Process the returned grades and add this student's grade information to
                		/// the return array.                
                    		if (!empty($grades_by_student)) {
                        		foreach ($grades_by_student as $grade) {
                            			if ($grade['student_data']['idnumber'] == $userid) {
                               				 if (is_array($grade['uncategorised'])) {
                                    				$rgrade->grades = $grade['uncategorised'];
                                    				$success        = true;
                                			}
                            			}
                        		}
                    		}
                    
                    		if (!$success) {
                        		$rgrade->error = 'No grade data for student ' . fullname($user) .
                                        	 ' in course ' . $course->fullname;
                    		}
                    } else {
			$rgrade->error=' not a teacher of course '.$course->fullname;
		    }

                } else {
                    $rgrade->error = 'Could not find course ' . $cid;
                }

                $return[] = $rgrade;
            }

            return $return;
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
            if (DEBUG) $this->debug_output("IDS=".print_r($userids,true));
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
	    /* not in moodle 1.7
            * $return->students = get_records('user_students', 'course', $course->id);
            */
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
		$res=new StdClass();
		$res->error=$msg;
		if (DEBUG)
			$this->debug_output("server.soap fatal error : $msg");
		return $res;
        }

	/**
	* return and object with error attribute set 
	* this record will be inserted in client array of responses
	* do not override in protocol-specific server subclass.
	*/
      function non_fatal_error($msg) {
                $res=new StdClass();
                $res->error=$msg;
                if (DEBUG)
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
                return has_capability('moodle/legacy:admin',
                                      get_context_instance(CONTEXT_SYSTEM, SITEID), $userid, false);
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
                return (has_capability('moodle/legacy:teacher',
                                       get_context_instance(CONTEXT_COURSE, $courseid), $userid, false) ||
                        has_capability('moodle/legacy:editingteacher',
                                       get_context_instance(CONTEXT_COURSE, $courseid), $userid, false));
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
            if ($includeadmin and $this->isadmin($userid)) {  // admins can do anything
                return true;
            }
            if ($this->using17) {
            	if (!record_exists('role_assignments', 'userid', $userid)) {    // Has no roles anywhere
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
	   } else {  //moodle < 1.7
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
                return has_capability('moodle/legacy:editingteacher',
                                      get_context_instance(CONTEXT_COURSE, $courseid), $userid, false);
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
                return has_capability('moodle/legacy:coursecreator',
                                      get_context_instance(CONTEXT_SYSTEM, SITEID), $userid, false);
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
            
            $fp = fopen($CFG->dataroot . '/debug.out', 'a');
            fwrite($fp, "[" . time() . "] $output\n");
            fflush($fp);
            fclose($fp);
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

        function get_primaryrole_incourse ($client,$sesskey,$userid,$useridfield,$courseid,$courseidfield) {
		
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }

                $cuid=$this->get_session_user($client);
                // convert user request criteria to an userid
                $user=get_record('user',$useridfield,$userid);
                if (! $user)
                        return $this->error ("user $useridfield='$userid' not found ");
                $userid=$user->id;
                // check rights
                if (($userid !=$cuid) && ! $this->isadmin($cuid))
                        return $this->error("You do not have proper access to perform this operation.");
                // convert course request criteria to a courseid
                $course=get_record('course',$courseidfield,$courseid);
                if (! $course)
                        return $this->error ("course $courseidfield='$courseid' not found");
                $courseid=$course->id;
		if ($this->isadmin($userid)) return 1;
		if ($this->iscreator($userid)) return 2;
		if ($this->isteacheredit($courseid,$userid)) return 3;
		if ($this->isteacher($courseid,$userid)) return 4;
		//student
                // strange : guest has also the course:view capability ?
                // so we treat it before regular student 
                 //guest
                 if ($this->using17) {
                       $context = get_context_instance(CONTEXT_SYSTEM, SITEID);
                       if (has_capability('moodle/legacy:guest', $context, $userid, false)) {
                             	if ($course->guest) return 6;
				else return 0;
			}
		}
                else {
                     if(isguest($userid)){
				if ($course->guest) return 6;
				else return 0;
                     }				
               }
                //student 
                if ($this->using17) {
                     $context = get_context_instance(CONTEXT_COURSE, $courseid);
                     if ( has_capability('moodle/course:view', $context,$userid,false)) return 5;
                } else {
                      if (isstudent($courseid,$userid)) return 5;
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

	function has_role_incourse ($client,$sesskey,$userid,$useridfield,$courseid,$courseidfield,$roleid) {
		
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }

		$cuid=$this->get_session_user($client);
		// convert user request criteria to an userid
		$user=get_record('user',$useridfield,$userid);
		if (! $user)
			return $this->error ("user $useridfield='$userid' not found ");
		$userid=$user->id;
                // check rights
                if (($userid !=$cuid) && ! $this->isadmin($cuid))
			return $this->error("You do not have proper access to perform this operation.");
                // convert course request criteria to a courseid
		$course=get_record('course',$courseidfield,$courseid);
                if (! $course)
                        return $this->error ("course $courseidfield='$courseid' not found");
                $courseid=$course->id;
		if (DEBUG) $this->debug_output("HRIC $userid $courseid $roleid ".print_r($user,true)." 
                             ".print_r($course,true));
		switch ($roleid) {
			case 1: return $this->isadmin($userid); break;
			case 2: return $this->iscreator($userid);break;
			case 3: return $this->isteacheredit($courseid,$userid); break;
			case 4: return $this->isteacher($courseid,$userid); break;
			case 5: //student
				if ($this->using17) {
					$context = get_context_instance(CONTEXT_COURSE, $courseid); 
					return has_capability('moodle/course:view', $context,$userid,false);
				} else {
					return isstudent($courseid,$userid);
				}
				break;
                         case 6: // guest TODO does not seems good since it does to check course
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
        function get_my_courses($client, $sesskey,$uinfo='',$idfield='id',$sort='') {
                if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }
                $cuid=$this->get_session_user($client);
                if ($uinfo) {
                     if ($idfield !='id') {   // find userid if not current user
                        if (! $user=get_record('user',$idfield,$uinfo)) 
                              return $this->error ("user not found with $idfield= '$uinfo'");
                        $uid=$user->id;
                     } else
                        $uid=$uinfo; // rev 1.5.10
                } else 
			$uid=$cuid;  //use current user and ignore $idfield 

                //only admin user can request courses for others
                if ($uid !=$cuid) {
			if (!$this->isadmin($cuid)) {
	                       	 return $this->error($cuid.' You do not have proper access to perform this operation.');
			}

		}
		$sort=$sort?$sort:'fullname';
                if (isguest($uid)) //isguest is deprecated by still used in Moodle's 1.7 index.php ? 
                       //strange: courses with guest=1 and a password are not returned ?
			$res=get_records('course','guest',1,$sort);
		 else 
                	$res = get_my_courses($uid,$sort);
                 if ($res) 
                       return $this->filter_courses($client,$res);
                 else 
                       return $this->non_fatal_error("no courses");
                
        }

        /**
          try to "emulate" Moodle 1.7 get_role_users at the best in Moodle 1.6
        */
        private function get_role_users_16 ($client,$course,$idrole) {
                global $CFG;
	        $select = 'SELECT u.* ';
                $where  = 'WHERE s.course = '.$course->id.' AND u.deleted = 0 ';
                $order='order by lastname,firstname';


	switch ($idrole) {
        	// case 0:; //all not permitted
		case 1: //admin
                  $from  = 'FROM '.$CFG->prefix.'user u ,'.$CFG->prefix.'user_admins s ';
                  $where =  'WHERE  s.userid = u.id ';
                  $this->debug_output($select.$from.$where.$order);
                  if ($res=get_records_sql($select.$from.$where.$order)) {
                        return $this->filter_users($client,$res);
                  }
                  else
                        return $this->error("get_user_bycourse : no admins ???");
                  break;
                case 2: // creator
                case 3: // teachers
                case 4:  // ne teacher
                  $not =$idrole==4? 'not':'';
                  $where .= ' and '.$not.' s.editall ' ;
                  if ($idrole==2) $where .=' and s.authority=1 ';
                  $from   = 'FROM '.$CFG->prefix.'user u LEFT JOIN '.$CFG->prefix.'user_teachers s ON s.userid = u.id ';
                  if ($res=get_records_sql($select.$from.$where.$order)) {
                        return $this->filter_users($client,$res);
                  }
                  else
                        return $this->non_fatal_error("get_user_bycourse : no match for student");
                  break;

                case 5: //students
                  $from   = 'FROM '.$CFG->prefix.'user u LEFT JOIN '.$CFG->prefix.'user_students s ON s.userid = u.id ';
                  if ($res=get_records_sql($select.$from.$where.$order)) {
			return $this->filter_users($client,$res);
                  }
		  else 
			return $this->non_fatal_error("get_user_bycourse : no match for student");
                  break;
                case 6:if ($course->guest)   //guest
                           return $this->filter_users($client,get_records('user','username','guest'));
                       else 
                           return $this->non_fatal_error("get_user_bycourse : no match for guest");
                       break;   //guest
               default : return $this->error("Role ID is incorrect");

         }
        }

        function get_users_bycourse($client,$sesskey,$idcourse,$idfield,$idrole=0) {

                 if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }
		if (! $course= get_record('course',$idfield,$idcourse)) {
		      return $this->error('Invalid course '.$idfield."=".$courseid);
        	}

                $cuid=$this->get_session_user($client);
                //only teacher or admin can do that ...
                if (!$this->isteacher($course->id, $cuid,true)) {
                        return $this->error('You do not have proper access to perform this operation.');
                }else {
                       if ($this->using17) {
                            if ($idrole) {
                                  if (!record_exists('role','id',$idrole))
                                  return $this->error("Role ID is incorrect");
                             }
                             $context = get_context_instance(CONTEXT_COURSE, $course->id);
                            // if ($res=get_role_users($idrole, $context, true, '*')) {   rev 1.5.12 01/07/2008
                               if ($res=get_role_users($idrole, $context, true, '')) {
				  return $this->filter_users($client,$res,$idrole);
                             } else {
                                   return $this->non_fatal_error("get_user_bycourse : no match");
                             }
                        } else {  //moodle < 1.7  
                              $ret=$this->get_role_users_16($client,$course,$idrole);
                        }
                }
                // file_put_contents("$CFG->dataroot/debug_pp.log",'get_users_bycourse'.print_r($res,true));
                return $ret;
        }

        function get_roles($client, $sesskey,$roleid='',$idfield='') {
           if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
           }
           $cuid=$this->get_session_user($client);
           //only teacher or admin can do that ...
           if (!$this->isteacherinanycourse($cuid,true)) {
                        return $this->error('You do not have proper access to perform this operation.');
           }else {

                if ($this->using17) {
                     // Get a list of all the roles in the database, sorted by their short names.
                      if ($res = get_records('role',$idfield, $roleid, 'shortname, id','*')) {
		 	return $res;

                    } else {
                         return $this->error("get_roles : search error");
                    }
               } else return $this->non_fatal_error("get roles : no roles in Moodle <1.7");
          }
        }

        function get_categories($client, $sesskey,$catid='',$idfield='') {
           if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
           }
           $ret = array();
          // Get a list of all the categories in the database, sorted by their names.
	  // TODO check permissions 
                if ($res = get_records('course_categories',$idfield,$catid, 'name','*')) {
                         $ret=$this->filter_categories($client,$res);

                } else {
                         return $this->error("get_categories : search error");
                }
          return $ret;
        }





       function get_events($client, $sesskey,$eventtype,$ownerid) {
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
          
           if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
           }
           $ret = array();
           $cuid=$this->get_session_user($client);
           //only teacher or admin can do that ...
           if (!$this->isteacherinanycourse($cuid,true)) {
                        return $this->error('You do not have proper access to perform this operation.');
                }else {
                 // Get a list of all the events in the database, sorted by their short names.
                 //TODO filter by eventype ...
                 switch ($eventtype)
                 {
                 	case cal_show_global: $idfield='courseid'; $ownerid=1;break;
                 	case cal_show_course :$idfield='courseid'; break;
                 	case cal_show_group : $idfield='groupeid'; break;
                 	case cal_show_user : $idfield='userid'; break;
                 	default: $idfield=''; $ownerid='';
                 }
                 
                if ($res = get_records('event', $idfield, $ownerid)) {
                         foreach ($res as $r) {
                         	$r=$this->filter_event($client,$eventtype,$r);
                             if ($r)  $ret[]=$r;
                                }

                } else {
                         return $this->error("get_events : search error");
                }
          }
          return $ret;
        }

	function get_group_members($client,$sesskey,$groupid) {
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
		}
		if (! record_exists('groups','id',$groupid)) {
			return $this->error('Invalid group '.$groupid);
		}
		$res=get_group_users($groupid);
		if (! $res)
			return $this->error('no group members.'.$groupid);
		return $this->filter_users($client,$res,0);

	}

	function get_my_id($client,$sesskey) {
                 if (!$this->validate_client($client, $sesskey)) {
                        return -1; //invalid Moodle's ID
                }
                return $this->get_session_user($client);
	}


	function get_groups_bycourse ($client,$sesskey,$courseid,$idfield='idnumber') {
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }
		if (! $course= get_record('course',$idfield,$courseid)) {
                        return $this->error('Invalid course '.$idfield."=".$courseid);
                }
		$res=get_groups($course->id);
                 //file_put_contents('$CFG->dataroot/debug_pp.log',
                 //  'get_groups_bycourse'.print_r($res,true));

                if (! $res)
                        return $this->non_fatal_error('no groups in course.'.$courseid);
                return $this->filter_groups($client,$res);

	}

	function get_groups($client, $sesskey,$groups,$idfield,$courseid){

		if (empty($groups) && $courseid) {
			return $this->get_groups_bycourse ($client,$sesskey,$courseid);
		}
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }
		
		global $CFG;
		$ret = array();
		if ($courseid) {
        		$courseselect = 'AND g.courseid ='.$courseid ;
		} else {
		        $courselect = '';
		}
		
		foreach ($groups as $group) {
			 $sql= "SELECT g.*
                                FROM {$CFG->prefix}groups g 
        	                     WHERE g.$idfield ='$group' $courseselect ";

			$rgroup=new StdClass();

         	   	/// This database operation MIGHT throw an HTML error message,
            		/// so we've got to catch that and send it back in an error
            		/// request.
                	ob_start();
	                $g = get_records_sql($sql);
	
        	        if (ob_get_length() && trim(ob_get_contents())) {
                		/// Return an error with  the contents of the output buffer.
                    		$msg = trim(ob_get_clean());
        	           	 $ret[]=$this->error ( 'Database error: ' . $msg);
                	}
                	ob_end_clean();

                	if (!empty($g)) {
	                        $g=$this->filter_groups($client,$g);
				foreach($g as $one) {
				               $ret[] = $one;
				}

	                } else {
         		        $ret[]=$this->non_fatal_error( "Invalid group $idfield :$group ");
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
	
	function get_my_groups($client, $sesskey,$uid) {
		if (!$this->validate_client($client, $sesskey)) {
                        return $this->error('Invalid client connection.');
                }
		
		$cuid= $this->get_session_user($client);
		if (!empty($uid) && ($uid !=$cuid))
			if (! $this->isadmin($cuid))
				return $this->error("only admins can do that");
		global $CFG;
		$uid=$uid?$uid:$cuid;
    		
		$sql="SELECT g.*
                      FROM {$CFG->prefix}groups g,
                      {$CFG->prefix}groups_members m
                      WHERE g.id = m.groupid
                      AND m.userid = '$uid'
                      ORDER BY name ASC";
		$res=get_records_sql($sql);
		//file_put_contents("$cfg->dataroot/debug_pp.log",'server:get_my_groups '.$sql.' '.print_r($res,true));
		return $this->filter_groups($client,$res);

	}


function get_last_changes($client, $sesskey,$courseid,$idfield='idnumber',$limit=10){
        global $CFG;
	        
	if (!$this->validate_client($client, $sesskey)) {
		return $this->error('Invalid client connection.');
	}
	if (! $course= get_record('course',$idfield,$courseid)) {
		return $this->error('Invalid course '.$idfield."=".$courseid);
	}

	$cuid= $this->get_session_user($client);
	$isTeacher=$this->isteacher($course->id,$cuid);
		
	//must have id as first field for proper array indexing !
	$sqlAct=<<<EOS
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
	$return=array();

	if (! $resultAct=get_records_sql($sqlAct)) {
		return $this->non_fatal_error("nada");
        }

	foreach($resultAct as $rowAct)  {
		if ($limit-- <=0)
			break;
		$id_cmid=$rowAct->cmid;
   		$id_autre="cmid=$id_cmid ";
		
		$sql=<<<EOS
			select {$CFG->prefix}modules.*,{$CFG->prefix}course_modules.instance,{$CFG->prefix}course_modules.visible
			from {$CFG->prefix}course_modules,{$CFG->prefix}modules
			where course=$course->id
			and {$CFG->prefix}course_modules.module={$CFG->prefix}modules.id
			and {$CFG->prefix}course_modules.id =$id_cmid
EOS;
		// toutes pour un prof, seulement les ressources visibles pour un �tudiant !!!
		if (!$isTeacher) {
			$sql.=" and {$CFG->prefix}course_modules.visible=1";	
		}
		if($row=get_record_sql($sql)) {
			$sql1=<<<EOS
				select * from {$CFG->prefix}{$row->name}
				where id={$row->instance}
				and course=$course->id
EOS;
			$result1=get_records_sql($sql1);
			foreach($result1 as $row1) {
				if ($row1->name) {

        		       //retouche  ?id=cc&r=xx ou ?f=xx
					switch ($row->name) {
						case 'forum': $question="view.php?f=$row1->id";break;
						case 'assignment': $question="submissions.php?id=$id_cmid";break;
						default : $question="view.php?id=$course->id&r=$row1->id";
					}
					$ret= new StdClass;
					$ret->error='';
                			$ret->id=$rowAct->id;
					$ret->courseid=$courseid;
					$ret->instance=$row->instance;
					$ret->resid=$row1->id;
					$ret->name=$row1->name;
					$ret->date=$rowAct->DATE_J;
					$ret->timestamp=$rowAct->time;
					$ret->type=$rowAct->action;
					$ret->author="$rowAct->firstname $rowAct->lastname";
					$ret->url=$rowAct->url;
					$ret->link=$CFG->wwwroot.'/mod/'.$row->name.'/'.$question;
					$ret->visible=$row->visible;
					$return[]=$ret;

				}
			}
		}
	}
	if(DEBUG) $this->debug_output(print_r($return,true));
	return $this->filter_changes($client,$return);
}    


function get_activities($client,$sesskey,
                        $userid,$useridfield,
                        $courseid,$courseidfield,$limit,$doCount=0) {

	if (!$this->validate_client($client, $sesskey)) {
                return $this->error('Invalid client connection.');
        }
	//resolve user criteria to an user  Moodle's id
        if (! $user= get_record('user',$useridfield,$userid)) {
                return $this->error('Invalid user '.$useridfield."=".$userid);
        }

	$cuid= $this->get_session_user($client);

	if($courseid) {
        	//resolve course criteria to a course Moodle's id
		if (! $course= get_record('course',$courseidfield,$courseid)) 
                	return $this->error('Invalid course '.$courseidfield."=".$courseid);
        	$sql_course=" AND  l.course=$course->id ";
		$canRead=$this->isteacher($course->id,$cuid);
	}else {
		$sql_course='';
		$canRead=$this->isadmin($cuid);
	}

	if (($cuid != $user->id) && !$canRead) {
		 return $this->error('You do not have proper access to perform this operation');
	}
	if ($doCount)
		// caution result MUST have some id value to fetch result later 
		$sql_select =" SELECT 1,count(l.userid) as CPT ";
	else {
		$sql_select=<<<EOS

SELECT l.*,u.auth,u.firstname,u.lastname,u.email,
u.firstaccess, u.lastaccess, u.lastlogin, u.currentlogin,
FROM_UNIXTIME(l.time,'%d/%m/%Y %H:%i:%s' )as DATE,
FROM_UNIXTIME(u.lastaccess,'%d/%m/%Y %H:%i:%s' )as DLA,
FROM_UNIXTIME(u.firstaccess,'%d/%m/%Y %H:%i:%s' )as DFA,
FROM_UNIXTIME(u.lastlogin,'%d/%m/%Y %H:%i:%s' )as DLL,
FROM_UNIXTIME(u.currentlogin,'%d/%m/%Y %H:%i:%s' )as DCL
EOS;
	}
	$sql=<<<EOSS
$sql_select
FROM mdl_log l , mdl_user u 
WHERE l.userid = u.id
AND u.id = $user->id 
$sql_course
ORDER BY l.time DESC 
EOSS;
	//$this->debug_output($sql);
	$res=get_records_sql($sql,'',$limit);
	//$this->debug_output(print_r($res,true));
	if ($doCount)
		return $res['1']->CPT;  //caution  
	else
		return $this->filter_activities($client,$res); 
		 //reconvert dates using userdate()
}




/**
* these function mask attributes or remove records depending of logged-in user rights
*/

	function filter_user($client,$user,$role) {
		if (isset($user->deleted) && $user->deleted)
			return false; 
		if ($user->emailstop)
                        $user->email="not disclosed by user's will";
		$user->password=''; //no way, even in  md5, can be cracked by reverse dictionnary
		$user->role=$role; // add a basic role info if available (see get_users_bycourse)
		return $user;
	}

	function filter_users($client,$users,$role) {
		$res=array();
		foreach($users as $user) {
			$user=$this->filter_user($client,$user,$role);
                       	if ($user)
                        	$res[]=$user;
		}
		return $res;
	}

	function filter_course ($client,$course) {
	//return false if not visible to $client 
		$cuid=$this->get_session_user($client);
		if ($this->isteacher($course->id,$cuid))   //rev 1.5.14 include admin (cf Florent Carlier)
			return $course;
                $course->password=''; // do not disclose it to non teacher 
                // question : is course's category is not visible, should we hide it ?
		if (!$this->using17)
			 return ($course->visible ? $course:false); //wrong if called by get_my_courses
		else { 
			// check capability , course maybe non visible
			$context = get_context_instance(CONTEXT_COURSE, $course->id);
                        if (has_capability('moodle/course:view', $context,$cuid,false))
				return $course;
                        else 
                                 return false;
			//return ($course->visible ? $course:false);  WRONG !
		}
	}

	function filter_courses($client,$courses) {
                $res=array();
                foreach($courses as $course) {
                        $course=$this->filter_course($client,$course);
                        if ($course)
                                $res[]=$course;
		}
                return $res;
        }

	function filter_category ($client,$category) {
		//return false if not visible to $client
		$uid = $this->get_session_user($client);
		if ($this->isadmin($uid))
			return $category;
		return $category->visible ? $category:false;
        }

	function filter_categories($client,$categories) {
                $res=array();
                foreach($categories as $category) {
                        $category=$this->filter_category($client,$category);
                        if ($category)
                                $res[]=$category;
		}
                return $res;
        }

	function filter_group ($client,$group) {
        //todo return false if not visible to $client
        // check user's membership to this group ? 
		$group->password='';
               return $group;
        }

        function filter_groups($client,$groups) {
                $res=array();
                foreach($groups as $group) {
                        $group=$this->filter_group($client,$group);
                        if ($group)
                                $res[]=$group;
		}
                return $res;
        }

        function filter_resource ($client,$resource) {
		if (isset($resource->error) && $resource->error) return $resource;
             	$resource->timemodified_ut=userdate($resource->timemodified);
        	//return false if resource->visible is false AND $client not "teacher"
		$cuid=$this->get_session_user($client);
                if ($this->isteacher($resource->course,$cuid))
			return $resource;
            	return $resource->visible ? $resource:false;
        }
        
        function filter_resources($client,$resources) {
                $res=array();
                foreach($resources as $resource) {
                        $resource=$this->filter_resource($client,$resource);
                        if ($resource)
                                $res[]=$resource;
                }
                return $res;
        }

	 function filter_section ($client,$section) {
        	if (isset($section->error) && $section->error) return $section;
		//return false if section->visible is false AND $client not "teacher"
		$cuid=$this->get_session_user($client);
                if ($this->isteacher($section->course,$cuid))
			return $section;
            	return $section->visible ? $section:false;
        }
        
        function filter_sections($client,$sections) {
                $res=array();
                foreach($sections as $section) {
                        $section=$this->filter_section($client,$section);
                        if ($section)
                                $res[]=$section;
                }
                return $res;
        }



	function filter_activity($client,$activity) {
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

	function filter_activities($client,$activities) {
                $res=array();
                foreach($activities as $activity) {
                        $activity=$this->filter_activity($client,$activity);
                        if ($activity)
                                $res[]=$activity;
                }
		//$this->debug_output(print_r($res,true));
                return $res;
        }



	function filter_change ($client,$change) {
                //return false if ressource changed is not visible to $client
                $uid = $this->get_session_user($client);
                if ($this->isteacher($change->courseid,$uid))
                        return $change;
                return $change->visible ? $change:false;
        }


	
	function filter_changes($client,$changes) {
                $res=array();
                foreach($changes as $change) {
                        $change=$this->filter_change($client,$change);
                        if ($change)
                                $res[]=$change;
                }
                return $res;
        }
        
    function filter_event($client,$eventype,$event) {
    	 $uid = $this->get_session_user($client);
         if ($this->isadmin($uid))
                        return $event;
    	switch ($eventype)    	{
    		case cal_show_user: 
    			if ($event->userid !=uid) return false;
    			else 
    			{
    				return $event;
    			}	
    		break;
    		case cal_show_group :
    			if (! ismember($event->groupeid,$uid))
    					return false;
    			else 
    				return $event;    			
    		break;
    		case cal_show_course :
    				//TODO check course rights and visibility 
    			return $event;
    		break;
    		default: return $event; 
    	}
    	
      }

//PP END




    }




?>
