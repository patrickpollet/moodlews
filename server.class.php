<?php


// $Id: server.class.php,v 1.5.4 2007/05/02 04:05:36 ppollet Exp $
/**
 * Base class for web services server layer. PP 5 ONLY.
 *
 * @package Web Services
 * @version $Id: server.class.php,v 1.5 2007/04//26 04:05:36 ppollet Exp $
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca> v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5, v 1.6
 * @author
 */
/* rev history
 @see revisions.txt
**/

require_once ('../config.php');
require_once ('filterlib.php');
/// increase memory limit (PHP 5.2 does different calculation, we need more memory now)
// j'ai 11000 comptes
@ raise_memory_limit("192M"); //fonction de lib/setuplib.php incluse via config.php
set_time_limit(0);
//define('DEBUG', true);  rev. 1.5.16 already set (or not) in  MoodleWS.php
define('cal_show_global', 1);
define('cal_show_course', 2);
define('cal_show_group', 4);
define('cal_show_user', 8);
/**
 * The main server class.
 *
 * The only methods that need to be extended in a child class are error() and any of
 * the service methods which need special transport-protocol specific handling of
 * input and / or output data (ie non simple type returns)
 *

 */
class server {
	var $version = 2009091000; // added ip in mdl_webservice_sessions
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
		/// Check for any DB upgrades.
		if (empty ($CFG->webservices_version)) {
			$this->upgrade(0);
		} else
			if ($CFG->webservices_version < $this->version) {
				$this->upgrade($CFG->webservices_version);
			}

		// setup default values if not set in admin screens (see admin/wspp.php)
		if (empty ($CFG->ws_sessiontimeout))
			$CFG->session_timeout = 1800;
		$this->sessiontimeout = $CFG->ws_sessiontimeout;

		if (!isset ($CFG->ws_logoperations))
			$CFG->logoperations = 1;
		if (!isset ($CFG->ws_logerrors))
			$CFG->logerrors = 0;
		if (!isset ($CFG->ws_logdetailedoperations))
			$CFG->logdetailledoperations = 0;
		if (!isset ($CFG->ws_debug))
			$CFG->wsdebug = 0;
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
		$this->debug_output('Starting WS upgrade from version ' . $oldversion . 'to version ' . $this->version);
		$return = true;
		require_once ($CFG->libdir . '/ddllib.php');
		if ($oldversion < 2006050800) {
			$return = install_from_xmldb_file($CFG->dirroot . '/wspp/db/install.xml');
		} else {
			if ($oldversion < 2007051000) {
				$table = new XMLDBTable('webservices_sessions');
				$field = new XMLDBField('ip');
				// since table exists, keep NULL as true and no default value !
				// otherwise XMLDB do not do the change but return true ...
				$field->setAttributes(XMLDB_TYPE_CHAR, '64');
				$return = add_field($table, $field, false, false);
			}
		}
		if ($return) {
			set_config('webservices_version', $this->version);
			$this->debug_output('Upgraded from ' . $oldversion . ' to ' . $this->version);
		} else {
			$this->debug_output('ERROR: Could not upgrade to version ' . $this->version);
		}
		return $return;
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
	 * Validate's that a client has an existing session.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @return boolean True if the client is valid, False otherwise.
	 */
	function validate_client($client = 0, $sesskey = '', $operation = '') {
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
		if ($sess->sessionbegin + $this->sessiontimeout < time()) {
			$sess->sessionend = time();
			update_record('webservices_sessions', $sess, 'id');
			return false;
		}

		$USER->id = $sess->userid;
		$USER->username = '';
		$USER->mnethostid = $CFG->mnet_localhost_id; //Moodle 1.95+ build sept 2009
        $USER->ip= getremoteaddr();
		unset ($USER->access); // important for get_my_courses !
		$this->debug_output("validate_client OK $client user=" . print_r($USER, true));

		//LOG INTO MOODLE'S LOG
		if ($CFG->ws_logoperations)
			add_to_log(SITEID, 'webservice', 'webservice pp', '', $operation);
		return true;
	}

	/**
	 * Sends an FATAL error response back to the client.
	 *
	 * @todo Override in protocol-specific server subclass, e.g. by throwing a PHP  exception
	 * @param string $msg The error message to return.
	 * @return An object with the error message string.(required by mdl_soapserver)
	 */
	function error($msg) {
        global $CFG;
		$res = new StdClass();
		$res->error = $msg;
		if ($CFG->ws_logerrors)
			add_to_log(SITEID, 'webservice', 'webservice pp', '', 'error :' . $msg);
		$this->debug_output("server.soap fatal error : $msg ". getremoteaddr());
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
	 * Do server-side debugging output (to file).
	 *
	 * @uses $CFG
	 * @param mixed $output Debugging output.
	 * @return none
	 */
	function debug_output($output) {
		global $CFG;
		if ($CFG->ws_debug) {
			$fp = fopen($CFG->dataroot . '/debug.out', 'a');
			fwrite($fp, "[" . time() . "] $output\n");
			fflush($fp);
			fclose($fp);
		}
	}

	/**
	 * check that current ws user has the required capability
	 * @param string capability
	 * @param string type on context CONTEXT_SYSTEM, CONTEXT_COURSE ....
	 * @param  object moodle's id
	 */
	function has_capability($capability, $context_type, $instance_id) {
		global $USER;
		$context = get_context_instance($context_type, $instance_id);
		return has_capability($capability, $context, $USER->id);
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

		if (!empty ($CFG->ws_disable))
			return $this->error(get_string('ws_accessdisabled', 'wspp'));
		if (!$this->using17)
			return $this->error(get_string('ws_nomoodle16', 'wspp'));

		/// Use Moodle authentication.
		/// FIRST make sure user exists , otherwise account WILL be created with CAS authentification ....
		if (!$knowuser = get_record('user', 'username', $username)) {
			return $this->error(get_string('ws_invaliduser', 'wspp'));
		}
		/// also make sure internal_authentication is used  (a limitation to fix ...)
		if (!is_internal_auth($knowuser->auth)) {
			return $this->error(get_string('ws_invaliduser', 'wspp'));
		}
		$user = authenticate_user_login(addslashes($username), $password);
		// $this->debug_output('return of a_u_l'. print_r($user,true));
		if (($user === false) || ($user && $user->id == 0) || isguestuser($user)) {
			return $this->error(get_string('ws_invaliduser', 'wspp'));
		}
		/// Verify that an active session does not already exist for this user.
		$userip = getremoteaddr(); // rev 1.5.4

		$sql = "SELECT s.* FROM {$CFG->prefix}webservices_sessions s
							WHERE s.userid = {$user->id} AND
							s.verified = 1 AND
							s.sessionend = 0 AND
							(" . time() . " - s.sessionbegin) < " . $this->sessiontimeout;
		if ($sess = get_record_sql($sql, 0)) {
			//return $this->error('A session already exists for this user (' . $user->login . ')');
            /*
			if ($sess->ip != $userip)
				return $this->error(get_string('ws_ipadressmismatch', 'wspp',$userip."!=".$sess->ip));
            */
			// V1.6 reuse current session
		} else {
			/// Login valid, create a new session record for this client.
			$sess = new stdClass;
			$sess->userid = $user->id;
			$sess->verified = true;
			$sess->ip = $userip;
			$sess->sessionbegin = time();
			$sess->sessionend = 0;
			$sess->sessionkey = $this->add_session_key();
			if ($sess->id = insert_record('webservices_sessions', $sess)) {
				if ($CFG->ws_logoperations)
					add_to_log(SITEID, 'webservice', 'webservice pp', '', __FUNCTION__);
			} else
				return $this->error(get_string('ws_errorregistersession','wspp'));

		}
		/// Return standard data to be converted into the appropriate data format
		/// for return to the client.
		$ret = array (
			'client' => $sess->id,
			'sessionkey' => $sess->sessionkey
		);
		$this->debug_output(print_r($ret, true));
		return $ret;
	}

	/**
	 * Logs a client out of the system by removing the valid flag from their
	 * session record and any user ID that is assosciated with their particular
	 * session.
	 *
	 * @param integer $client The client record ID.
	 * @param string $sesskey The client session key.
	 * @return boolean True if successfully logged out, false otherwise.
     * since this operation retunr s a simple type, no need to override it in protocol specific layer
	 */
	function logout($client, $sesskey) {
		if (!$this->validate_client($client, $sesskey)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if ($sess = get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
			$sess->verified = 0;
			$sess->sessionend = time();
			if (update_record('webservices_sessions', $sess)) {
				if ($CFG->ws_logoperations)
					add_to_log(SITEID, 'webservice pp', '', 'logout');
				return true;
			} else {
				if ($CFG->ws_logerrors)
					add_to_log(SITEID, 'webservice', 'webservice pp', '', 'error'.__FUNCTION__);
				return false;
			}
		}
		return false;
	}

	function get_version($client, $sesskey) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey)) {
			return -1; //invalid Moodle's ID
		}
		return $CFG->webservices_version;
	}

	/**
	 * Find and return a list of user records.
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $userids An array of input user values. If empty, return all users
	 * @param string $idfield The field used to compare the user ID fields against.
	 * @return array Return data (user record) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function get_users($client, $sesskey, $userids, $idfield = 'idnumber') {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		/// Verify that the user for this session can perform this operation.
		//nothing to check user database is public ?
		$ret = array (); // Return array.
		if (empty ($userids)) { // all users ...
			return filter_users($client, get_users(true), 0);
		}
		foreach ($userids as $userid) {
			$users = get_records('user', $idfield, $userid); //may have more than one !
			if (empty ($users)) {
				$a = new StdClass();
				$a->critere = $idfield;
				$a->valeur = $userid;
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
			} else {
				$ret = array_merge($ret, $users);
			}
		}
		//$this->debug_output("GU" . print_r($ret, true));
		return filter_users($client, $ret, 0);
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
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			// all courses wanted
			$res = get_records('course', '', '');
			return filter_courses($client, $res);
		}
		foreach ($courseids as $courseid) {
			if ($courses = get_records('course', $idfield, $courseid)) { //may have more than one
				$ret = array_merge($ret, $courses);
			} else {
				$a = new StdClass();
				$a->critere = $idfield;
				$a->valeur = $courseid;
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
			}
		}
		return filter_courses($ret);
	}

	/**
	 * Find and return a list of resources within one or several courses.
	 * OK PP tested with php5 5 and python clients
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $courseids An array of input course id values to search for. If empty return all ressources
	 * @param string $idfield : the field used to identify courses
	 * @return array An array of  records.
	 */
	function get_resources($client, $sesskey, $courseids, $idfield = 'idnumber') {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
		  $courses = get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
				}
			}
		}
		//remove courses not available to current user
		$courses = filter_courses($client, $courses);
		$ilink = "{$CFG->wwwroot}/mod/resource/view.php?id=";
		foreach ($courses as $course) {
			if ($resources = get_all_instances_in_course("resource", $course, NULL, true)) {
				foreach ($resources as $resource) {
					$resource->url = $ilink . $resource->coursemodule;
					$ret[] = $resource;
				}
			}
		}
        //remove ressources in course where current user is not enroled
		return filter_resources($client, $ret);
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
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			$courses = get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
				}
			}
		}
		//remove courses not available to current user
		$courses = filter_courses($client, $courses);
		foreach ($courses as $course) {
			if ($resources = get_all_sections($course->id))
				foreach ($resources as $resource) {
				$ret[] = $resource;
			}
		}
         //remove ressources in course where current user is not enroled
		return filter_sections($client, $ret);
	}

	public function get_instances_bytype($client, $sesskey, $courseids, $idfield = 'idnumber', $type) {
		//TODO merge with get_resources by giving $type="resource"
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if (empty($type)) {
			return $this->error(get_string('ws_emptyparameter', 'wspp','type'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			$courses = get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
				}
			}
		}
		//remove courses not available to current user
		$courses = filter_courses($client, $courses);
		foreach ($courses as $course) {
			if (!$resources = get_all_instances_in_course($type, $course, NULL, true)) {
				//append an error record to the list
				$a = new StdClass();
				$a->critere = 'type';
				$a->valeur = $type;
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'wspp', $a));
			}else {
				$ilink = "{$CFG->wwwroot}/mod/$type/view.php?id=";
				foreach ($resources as $resource) {
					$resource->url = $ilink . $resource->coursemodule;
					$ret[] = $resource;
				}
			}
		}
		//remove ressources in course where current user is not enroled
		return filter_resources($client, $ret);
	}


	/**
	     * Find and return student grades for currently enrolled courses  Function for Moodle 1.9)
	     *
	     * @uses $CFG
	     * @param int $client The client session ID.
	     * @param string $sesskey The client session key.
	     * @param string $userid The unique id of the student.
	     * @param string $useridfield The field used to identify the student.
	     * @param string $courseids Array of courses ids
	     * @param string $idfield  field used for course's ids (idnumber, shortname, id ...)
	     * @return userGrade [] The student grades
	     *
	*/
	function get_grades($client, $sesskey, $userid, $useridfield = 'idnumber', $courseids, $courseidfield = 'idnumber') {
		global $CFG;

		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
        if (empty ($courseids))
            return server :: get_user_grades($client, $sesskey, $userid, $useridfield);


         if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'wspp'));

        require_once ($CFG->dirroot . '/grade/lib.php');
        require_once ($CFG->dirroot . '/grade/querylib.php');

		if (!$user = get_record('user', $useridfield, $userid)) {
			return $this->error(get_string('ws_userunknown','wspp',$userid));
		}
		$return = array ();
		/// Find grade data for the requested IDs.
		foreach ($courseids as $cid) {
			$rgrade = new stdClass;
			/// Get the student grades for each course requested.
			if ($course = get_record('course', $courseidfield, $cid)) {
				if ($this->has_capability('moodle/grade:viewall', CONTEXT_COURSE, $course->id)) {
					//  get the floating point final grade
					if ($legrade = grade_get_course_grade($user->id, $course->id)) {
						$rgrade = $legrade;
						$rgrade->error = '';
						$rgrade->itemid = $cid;
					} else {
                        $a=new StdClass();
                        $a->user=fullname($user);
                        $a->course= $course->fullname;
						$rgrade->error = get_string('ws_nogrades','wspp',$a);
					}
				} else {
					$rgrade->error= get_string('ws_noseegrades','wspp',$course->fullname);
				}
			} else {
				$rgrade->error = get_string('ws_courseunknown','wspp', $cid);
			}
			$return[] = $rgrade;
		}
		//$this->debug_output("GG".print_r($return, true));
		return filter_grades($client, $return);
	}
	/**
	 * return user's grade in all courses
	 * @use get_grades by first creating an array of courses Moodle's ids
	 */

	public function get_user_grades($client, $sesskey, $userid, $idfield = "idnumber") {

        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'wspp'));
        }
        if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'wspp'));

        if (!$user = get_record('user', $idfield, $userid)) {
			return $this->error(get_string('ws_userunknown','wspp',$idfield.'='.$userid));
		}
		// we cannot call  API grade_get_course_grade($user->id) since it does not set the courseid as we want it
		if (!$courses = get_my_courses($user->id, $sort = 'sortorder ASC', $fields = 'idnumber')) {
			return $this->error(get_string('ws_nocourseforuser','wspp',$userid));
		}
		$courseids = array ();
		foreach ($courses as $c)
			if (!empty ($c->idnumber))
				$courseids[] = $c->idnumber;
		//$this->debug_output("GUG=" . print_r($courseids, true));

		if (empty ($courseids))
			return $this->error(get_string('ws_nocoursewithidnumberforuser','wspp', $userid));
		// caution not $this->get_user_grades THAT WILL call mdl_sopaserver::get_grades
		// resulting in two calls of to_soaparray !!!!
		return server :: get_grades($client, $sesskey, $userid, $idfield, $courseids, 'idnumber');
	}

	public function get_course_grades($client, $sesskey, $courseid, $idfield = "idnumber") {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

         if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'wspp'));

        require_once ($CFG->dirroot . '/grade/lib.php');
        require_once ($CFG->dirroot . '/grade/querylib.php');

		$return = array ();
		//Get all student grades for course requested.
		if ($course = get_record('course', $idfield, $courseid)) {
			$context = get_context_instance(CONTEXT_COURSE, $course->id);
			if (has_capability('moodle/grade:viewall', $context)) {
				$students = array ();
				$students = get_role_users(5, $context, true, '');
				//$this->debug_output("GcG".print_r($students, true));
				foreach ($students as $user) {
					if ($legrade = grade_get_course_grade($user->id, $course->id)) {
						$rgrade = $legrade;
						$rgrade->error = '';
						$rgrade->itemid = $user->idnumber;
						//  $this->debug_output("IDS=".print_r($legrade,true));
						$return[] = $rgrade;
					} else {
                         $a=new StdClass();
                        $a->user=fullname($user);
                        $a->course= $course->fullname;
                        $rgrade->error = get_string('ws_nogrades','wspp',$a);
					}
				}
			} else {
				$rgrade->error = get_string('ws_noseegrades','wspp',$course->fullname);
				$return[] = $rgrade;
			}
		} else {
			$rgrade->error = get_string('ws_courseunknown','wspp', $cid);
			$return[] = $rgrade;
		}
		//$this->debug_output("GcG".print_r($return, true));
		return filter_grades($client, $return);

	}

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
    * since this operation retunr s a simple type, no need to override it in protocol specific layer
	*/
	function get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		// convert user request criteria to an userid
		$user = get_record('user', $useridfield, $userid);
		if (!$user)
			return $this->error(get_string('ws_userunknown','wspp',$useridfield."=".$userid));
		$userid = $user->id;
		// convert course request criteria to a courseid
		$course = get_record('course', $courseidfield, $courseid);
		if (!$course)
			return $this->error(get_string('ws_courseunknown','wspp',$courseidfield."=".$courseid ));
		return ws_get_primaryrole_incourse($course->id, $userid);
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
    * since this operation retunr s a simple type, no need to override it in protocol specific layer
	*/
	function has_role_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $roleid) {
		$tmp = server :: get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield);
		return ($tmp <= $roleid);
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
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$cuid = $USER->id;
		if ($uinfo) {
			if ($idfield != 'id') { // find userid if not current user
				if (!$user = get_record('user', $idfield, $uinfo))
					return $this->error(get_string('ws_userunknown','wspp',idfield."=".$uinfo));
				$uid = $user->id;
			} else
				$uid = $uinfo; // rev 1.5.10
		} else
			$uid = $cuid; //use current user and ignore $idfield
		//only admin user can request courses for others
		if ($uid != $cuid) {
			if (!$this->has_capability('moodle/user:loginas', CONTEXT_SYSTEM, 0)) {
				return $this->error(get_string('ws_operationnotallowed','wspp'));
			}
		}

		$sort = $sort ? $sort : 'fullname';
		if (isguestuser($user))
			$res = get_records('course', 'guest', 1, $sort);
		else
			$res = get_my_courses($uid, $sort);
		if ($res)
			return filter_courses($client, $res);
		else
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
	}

/**
 * returns users havaing $idrole in course identified by $idcourse
 * @param string $idcourse unique identifierr of course
 * @param string $idfield  name of field used to finc course (idnumber, id, shortname), should be unique
 * @param integer $idrole  role searched for (0 = any role)
 */

	function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole = 0) {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if (!$course = get_record('course', $idfield, $idcourse)) {
			return $this->error(get_string('ws_courseunknown','wspp',$idfield."=".$idcourse ));
		}
		if (!$this->has_capability('moodle/course:view', CONTEXT_COURSE, $course->id))
			return $this->error(get_string('ws_operationnotallowed','wspp'));

		if (!empty ($roleid) && !record_exists('role', 'id', $idrole))
            return $this->error(get_string('ws_roleunknown','wspp',$idrole ));
		$context = get_context_instance(CONTEXT_COURSE, $course->id);
		if ($res = get_role_users($idrole, $context, true, '')) {
			return filter_users($client, $res, $idrole);
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		}
	}

	function get_roles($client, $sesskey, $roleid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		// Get a list of all the roles in the database, sorted by their short names.
		if ($res = get_records('role', $idfield, $roleid, 'shortname, id', '*')) {
			return $res;
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		}
	}

	function get_categories($client, $sesskey, $catid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		// Get a list of all the categories in the database, sorted by their name
		if ($res = get_records('course_categories', $idfield, $catid, 'name', '*')) {
			return filter_categories($client, $res);
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		}
	}

	function get_events($client, $sesskey, $eventtype, $ownerid,$owneridfield='id') {
		global $USER;

		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();

		// Get a list of all the events in the database, sorted by their short names.
		//TODO filter by eventype ...
		switch ($eventtype) {
			case cal_show_global :
				$idfield = 'courseid';
				$ownerid = 1;
				break;
			case cal_show_course :
				$idfield = 'courseid';
                if (!$course =get_record('course',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_courseunknown','wspp',$owneridfield."=".$ownerid ));
                }
                $ownerid=$course->id;
				break;
			case cal_show_group :
				$idfield = 'groupid';
                if (!$group =get_record('groups',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_groupunknown','wspp',$owneridfield."=".$ownerid ));
                }
                 $ownerid=$group->id;
				break;
			case cal_show_user :
				$idfield = 'userid';
                if (!$user =get_record('user',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_userunknown','wspp',$owneridfield."=".$ownerid ));
                }
                 $ownerid=$user->id;
				break;
			default :
				$idfield = '';
				$ownerid = '';
		}
		if ($res = get_records('event', $idfield, $ownerid)) {
			foreach ($res as $r) {
				$r = filter_event($client, $eventtype, $r);
				if ($r)
					$ret[] = $r;
			}
		} else {
			$ret[]=$this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		}

		return $ret;
	}

	function get_group_members($client, $sesskey, $groupid,$groupidfield='id') {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if (!$group = get_record('groups', $groupidfield, $groupid)) {
			return $this->error(get_string('ws_groupunknown','wspp',$groupid));
		}

		if (!$this->has_capability('moodle/course:view', CONTEXT_COURSE, $group->courseid))
			return $this->error(get_string('ws_operationnotallowed','wspp'));
		$res = get_group_users($groupid);
		if (!$res)
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		return filter_users($client, $res, 0);
	}

	function get_my_id($client, $sesskey) {
		global $USER;
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return -1; //invalid Moodle's ID
		}
		return $USER->id;
	}

	function get_groups_bycourse($client, $sesskey, $courseid, $idfield = 'idnumber') {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if (!$course = get_record('course', $idfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','wspp',$idfield."=".$courseid ));
		}

		if (!$this->has_capability('moodle/course:view', CONTEXT_COURSE, $course->id))
			return $this->error(get_string('ws_operationnotallowed','wspp'));
		$res = get_groups($course->id);
		if (!$res)
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
		return filter_groups($client, $res);
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
	function get_my_groups($client, $sesskey, $uinfo = '', $idfield = "idnumber") {
		global $USER, $CFG;
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$cuid = $USER->id;
		if ($uinfo) {
			if ($idfield != 'id') { // find userid if not current user
				if (!$user = get_record('user', $idfield, $uinfo))
					return $this->error(get_string('ws_userunknown','wspp',$idfield."=".$uinfo));
				$uid = $user->id;
			} else
				$uid = $uinfo; // rev 1.5.10
		} else
			$uid = $cuid; //use current user and ignore $idfield
		//only an user that can login as another can request  for others
		if ($uid != $cuid) {
			if (!$this->has_capability('moodle/user:loginas', CONTEXT_SYSTEM, 0)) {
				return $this->error(get_string('ws_operationnotallowed','wspp'));
			}
		}
		$uid = $uid ? $uid : $cuid;
		$sql = "SELECT g.*
															 FROM {$CFG->prefix}groups g,
															 {$CFG->prefix}groups_members m
															 WHERE g.id = m.groupid
															 AND m.userid = '$uid'
															 ORDER BY name ASC";
		$res = get_records_sql($sql);
		return filter_groups($client, $res);
	}

	function get_last_changes($client, $sesskey, $courseid, $idfield = 'idnumber', $limit = 10) {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		if (!$course = get_record('course', $idfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','wspp',$idfield."=".$courseid ));
		}
		$cuid = $USER->id;
		$isTeacher = $this->has_capability("moodle/course:update", CONTEXT_COURSE, $course->id);
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
			return $this->non_fatal_error(get_string('ws_nothingfound','wspp'));
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

		//$this->debug_output(print_r($return, true));
		return filter_changes($client, $return);
	}

	/**
	 * return all logged actions of user in one course or any course
	 */

	function get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, $doCount = 0) {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		//resolve user criteria to an user  Moodle's id
		if (!$user = get_record('user', $useridfield, $userid)) {
			return $this->error(get_string('ws_userunknown','wspp',$useridfield."=".$userid));
		}
		$cuid = $USER->id;
		if ($courseid) {
			//resolve course criteria to a course Moodle's id
			if (!$course = get_record('course', $courseidfield, $courseid))
				return $this->error(get_string('ws_courseunknown','wspp',$courseidfield."=".$courseid ));
			$sql_course = " AND  l.course=$course->id ";
			$canRead = $this->has_capability('coursereport/log:view', CONTEXT_COURSE, $course->id);
		} else {
			$sql_course = '';
			$canRead = $this->has_capability('coursereport/log:view', CONTEXT_SYSTEM, 0);
		}
		if (($cuid != $user->id) && !$canRead) {
			return $this->error(get_string('ws_operationnotallowed','wspp'));
		}
		if ($doCount) // caution result MUST have some id value to fetch result later
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
			return filter_activities($client, $res);
		//reconvert dates using userdate()
	}

	/**
	 * Enrol users as a student in the given category
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param string $courseid The course ID number to enrol students in <- changed to category...
	 * @param array $userids An array of input user idnumber values for enrolment.
	 * @param string $idfield identifier used for users . Note that $courseid is expected
	 *    to contains an idnumber and not Moodle id.
	 * @return array Return data (user_student records) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function affect_role_incourse($client, $sesskey, $rolename, $courseid, $courseidfield, $userids, $useridfield = 'idnumber', $enrol = true) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		global $CFG, $USER;

		if (!($role = get_record('role', 'shortname', $rolename))) {
            return $this->non_fatal_error(get_string('ws_roleunknown','wspp',$rolename));
		}

		$groupid = 0; // for the role_assign function (what does this )
		if (!$course = get_record('course', $courseidfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','wspp',$courseidfield."=".$courseid ));
		}
		$context = get_context_instance(CONTEXT_COURSE, $course->id);
		if (!has_capability("moodle/role:assign", $context))
			return $this->error(get_string('ws_operationnotallowed','wspp'));
		if ($course->enrolperiod) {
			$timestart = time();
			$timeend = $timestart + $course->enrolperiod;
		} else {
			$timestart = $timeend = 0;
		}
		$this->debug_output("IDS=" . print_r($userids, true) . "\n" . $enrol);
		$return = array ();
		if (!empty ($userids)) {
			foreach ($userids as $userid) {
				$st = new enrolRecord();
				if (!$leuser = get_record('user', $useridfield, $userid)) {
					$st->error =get_string('ws_userunknown','wspp',$useridfield."=".$userid);
				} else {
					$st->userid = $leuser-> $useridfield; //return the sent value
					$st->course = $course-> $courseidfield;
					$st->timestart = $timestart;
					$st->timeend = $timeend;
					if ($enrol) {
						if (!role_assign($role->id, $leuser->id, $groupid, $context->id, $timestart, $timeend, 0, 'webservice')) {
							$st->error = "error enroling";
							$op = "error enroling " . $st->userid . " to " . $st->course;
						} else {
							$st->enrol = "webservice";
							$op = $rolename . " " . $st->userid . " added to " . $st->course;
						}
					} else {
						if (!role_unassign($role->id, $leuser->id, $groupid, $context->id)) {
							$st->error = "error unenroling";
							$op = "error unenroling " . $st->userid . " from " . $st->course;
						} else {
							$st->enrol = "no";
							$op = $rolename . " " . $st->userid . " removed from " . $st->course;
						}
					}
				}
				$return[] = $st;
				if ($CFG->ws_logdetailedoperations)
					add_to_log(SITEID, 'webservice', 'webservice pp', '', $op);
			}
		} else {
			$st = new enrolRecord();
			$st->error = get_string('ws_nothingtodo','wspp');
			$return[] = $st;
		}
		//$this->debug_output("ES" . print_r($return, true));
		return $return;
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
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$uid = $USER->id;
		$rusers = array ();
		$this->debug_output('Attempting to update user IDS: ' . print_r($users, true));
		if (!empty ($users)) {
			foreach ($users->users as $user) {
				$ruser = new stdClass();

				$this->debug_output('traitement de ' . print_r($user, true));
				//obs by Lille: add md5 to the password
				// todo test whether it is needed or not ?
				$user->password = md5($user->password);
				switch (trim(strtolower($user->action))) {
					case 'add' :

						if (!$this->has_capability('moodle/user:add', CONTEXT_SYSTEM, 0)) {
							$ruser->error = "not allowed to add users";
							break;
						}
						unset ($user->action);
						$this->debug_output('adding' . print_r($user, true));
						//Moodle 1.8 and later (a required field that must be non 0 for login )
						if (!empty ($CFG->mnet_localhost_id))
							if (empty ($user->mnethostid)) //if not set by caller
								$user->mnethostid = $CFG->mnet_localhost_id; // always local user

						// Lille : verify if current user is already in database
						if ($userExist = get_record("user", "username", $user->username)) {
							$ruser = $userExist;
							$ruser->error = "user $user->username  already exists";
							break;
						}
						// end Lille
						if (empty ($user->confirmed)) {
							$user->confirmed = true;
						}
						$user->id = insert_record('user', $user);

						$this->debug_output('ID is ' . $user->id);

						if (empty ($user->id)) {
							$ruser->error = 'Could not add user: ' . fullname($user);
						} else {
							$ruser = get_record('user', 'id', $user->id);
						}
						break;

					case 'update' :
						if (!$this->has_capability('moodle/user:update', CONTEXT_SYSTEM, 0)) {
							$ruser->error = "not allowed to update users";
							break;
						}
						$uid = $user->idnumber;
						unset ($user->action);
						$this->debug_output('Attempting to update user ID: ' . $uid);

						if (!$userup = get_record('user', 'idnumber', $uid)) {
							$ruser = $user;
							$ruser->error =get_string('ws_userunknown','wspp','idnumber='.$uid);
							break;

						} else {
							/// Update values in the $user database record with what
							/// the client supplied.
							foreach ($user as $key => $value)
								if (!empty ($value)) // rev 1.5.15 must ignore empty values ! serious flaw !
									$userup-> $key = $value;
							$userup->timemodified = time();

							if (update_record('user', $userup)) {
								$ruser = $ruser = get_record('user', 'id', $user->id);
							} else {
								$ruser = $user;
								$ruser->error = 'Could not update user: ' . $uid;
							}
						}
						break;
					case 'delete' :
						$uid = $user->idnumber;
						/// Deleting an existing user.
						if (!$this->has_capability('moodle/user:delete', CONTEXT_SYSTEM, 0)) {
							$ruser->error = "not allowed to delete users";
							break;
						}
						$ruser = $user;
						if ($userdel = get_record('user', 'idnumber', $uid)) {
							if (!delete_user($userdel)) {
								$ruser->error = "database error when deleting user with idnumber $uid";
							}
						} else {
							$ruser->error = "delete: user with idnumber $uid not found";

						}

						break;

				}
				$rusers[] = $ruser;
			}
		}
		return $rusers;
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
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$uid = $USER->id;
		$site = get_site();
		$ret = array ();
		if (!empty ($courses)) {
			foreach ($courses->courses as $course) {
				$rcourse = new stdClass;
				switch (trim(strtolower($course->action))) {
					case 'add' :
						/// Adding a new course.
						$courseadd = $course;

						$this->debug_output('Trying to add a new course.');
						/// Check for correct permissions.
						if (!$this->iscreator($uid)) {

							$this->debug_output('Invalid access UID: ' . $uid);
							$rcourse->error = 'You do not have proper access to perform this operation.';
						} else
							if (record_exists('course', 'idnumber', $courseadd->idnumber)) {
								$rcourse->error = 'A course with this ID number already exists: ' . $courseadd->idnumber;
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

								// place at beginning of category
								fix_course_sortorder();
								$courseadd->sortorder = get_field_sql("SELECT min(sortorder)-1 FROM " . "{$CFG->prefix}course WHERE category=$courseadd->category");
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

								if (empty ($courseadd->id)) {
									$rcourse->error = 'Could not add course: ' . $courseadd->shortname;
								} else {
									require_once ($CFG->libdir . '/pagelib.php');
									require_once ($CFG->libdir . '/blocklib.php');
									/// These API calls MIGHT throw an HTML error message,
									/// so we've got to catch that and send it back in an error
									/// request.

									/// Setup page blocks.
									$page = page_create_object(PAGE_COURSE_VIEW, $courseadd->id);
									blocks_repopulate_page($page);

									/// Create a default section.
									$section = NULL;
									$section->course = $courseadd->id;
									$section->section = 0;
									$section->id = insert_record('course_sections', $section);

									$rcourse = get_record('course', 'id', $courseadd->id);
								}
							}
						break;
						/********************************
						case 'update' :
							/// Updating an existing course.
							$courseup = $course;
							$cid = $courseup->idnumber;
							$dbfail = false;

							$this->debug_output('Attempting to update course ID: ' . $cid . print_r($course, true));
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.

							$course = get_record('course', 'idnumber', $cid);

							if (empty ($course)) {
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

										$success = update_record('course', $course);

										if (!$success) {
											$rcourse->error = 'Could not update course: ' . $cid;
										} else

											$rcourse = get_record('course', 'id', $course->id);
									}
						}

						break;
						****************************************************************/
					case 'delete' :
						/// Deleting an existing course.
						$cid = $course->idnumber;
						$dbfail = false;
						/// Check for correct permissions.
						if (!$this->isadmin($uid)) {
							$rcourse->error = 'You do not have proper access to ' . 'perform this operation.';
						} else {

							$this->debug_output('Attempting to delete course ID: ' . $cid);
							/// This database operation MIGHT throw an HTML error message,
							/// so we've got to catch that and send it back in an error
							/// request.

							$course = get_record('course', 'idnumber', $cid);

							if (empty ($course)) {
								$rcourse->error = get_string('ws_courseunknown','wspp',"idnumber=".$cid );
							} else
								if (!$dbfail) {
									/// 'Delete' the course the Moodle way.
									$success_r = true;
									$success_d = true;
									$success_f = true;
									/// These operations MIGHT throw an HTML error message,
									/// so we've got to catch that and send it back in an error
									/// request.

									require_once ($CFG->libdir . '/moodlelib.php');
									$success_r = remove_course_contents($course->id, false);

									if ($success_r) {
										$success_d = delete_records('course', 'id', $course->id);
									}

									if ($success_r && $success_d && !isset ($rcourse->error) && ($dir = @ opendir($CFG->dataroot . '/' . $course->id))) {
										closedir($dir);
										require_once ($CFG->libdir . '/filelib.php');
										$success_f = fulldelete($CFG->dataroot . '/' . $course->id);
									}

									if (!isset ($rcourse->error)) {
										if (!$success_r) {
											$rcourse->error = 'Error deleting some of the course contents (' . $cid . ').';
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($labels)) {
			foreach ($labels->labels as $label) {
				switch (trim(strtolower($label->action))) {
					case 'add' :
						/// Adding a new label.
						$labeladd = $label;

						$this->debug_output('EDIT_LABELS:    Trying to add a new label.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rlabel->error = "EDIT_LABELS:  Operation Update not implemented yet!";
						break;
					case 'delete' :
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($categories)) {
			foreach ($categories->categories as $category) {
				switch (trim(strtolower($user->action))) {
					case 'add' :
						/// Adding a new category.
						$categoryadd = $category;

						$this->debug_output('EDIT_CATEGORIES:    Trying to add a new category.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/category:create', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						/// Updating an existing category.
						$cid = $category->id;
						$cname = $category->name;

						$this->debug_output('EDIT_CATEGORIES:    Attempting to update category ID: ' . $cid . print_r($category, true));
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.

						if (!$this->has_capability("moodle/category:update", CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'delete' :
						/// Deleting an existing category.
						$cname = $category->name;
						$cid = $category->id;

						$this->debug_output('EDIT_CATEGORIES:    Attempting to delete category ID: ' . $cid);
						/// This database operation MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.

						/// Check for correct permissions.
						if (!$this->has_capability("moodle/category:delete", CONTEXT_SYSTEM, 0)) {
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

							}
						}
						if (!$deleted_commit) {
							$rcategory->error = "EDIT_CATEGORIES:   Could not delete category with id $cid or name $cname.";
							break;
						}

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
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($sections)) {
			foreach ($sections->sections as $section) {
				switch (trim(strtolower($section->action))) {
					case 'add' :
						/// Adding a new section.
						$sectionadd = $section;

						$this->debug_output('EDIT_SECTIONS:    Trying to add a new section.');
						/// These database operations MIGHT throw an HTML error message,
						/// so we've got to catch that and send it back in an error
						/// request.

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:update', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rsection->error = "EDIT_SECTIONS:  Operation Update not implemented yet!";
						break;
					case 'delete' :
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
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($forums)) {
			foreach ($forums->forums as $forum) {
				switch (trim(strtolower($forum->action))) {
					case 'add' :
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

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rforum->error = "EDIT_FORUMS:     Operation Update not implemented yet!";
						break;
					case 'delete' :
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($groups)) {
			foreach ($groups->groups as $group) {
				switch (trim(strtolower($group->action))) {
					case 'add' :
						/// Adding a new group.
						$groupadd = $group;

						$this->debug_output('EDIT_GROUPS: Trying to add a new group.');

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						/// Updating an existing group

						if (!$this->has_capability('moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'delete' :
						/// Deleting an existing group.
						$gid = $group->id;

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($assignments)) {
			foreach ($assignments->assignments as $assignment) {
				switch (trim(strtolower($assignment->action))) {
					case 'add' :
						$assignmentadd = $assignment;
						//creation of the new assignment

						if (!$this->has_capability('moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rassignment->error = "EDIT_ASSIGNMENTS:     Operation Update not implemented.";
						break;
					case 'delete' :
						//delete assignment
						$del = $assignment;

						if (!$this->has_capability('moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($databases)) {
			foreach ($databases->databases as $database) {
				switch (trim(strtolower($database->action))) {
					case 'add' :
						//add a new database
						$dtbadd = $database;

						if (!$this->has_capability('moodle/category:manageactivities', CONTEXT_SYSTEM, 0)) {

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

						break;
					case 'update' :
						//not implemented
						$rdatabase->error = "EDIT_DATABASES:    The action UPDATE is'n implemented";
						break;
					case 'delete' :
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($wikis)) {
			foreach ($wikis->wikis as $wiki) {
				switch (trim(strtolower($wiki->action))) {
					case 'add' :
						$this->debug_output('EDIT_WIKIS:     Trying to add a new wiki.');
						/// Adding a new wiki
						$wikiadd = $wiki;

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rwiki->error = "EDIT_WIKIS:  Operation Update not implemented yet";
						break;
					case 'delete' :

						$this->debug_output('EDIT_WIKIS:     Trying to remove wiki.');
						$wikidelete = $wiki;
						$wikiId = $wikidelete->id;

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if (!empty ($pagesWiki)) {
			foreach ($pagesWiki->pagesWiki as $page) {

				switch (trim(strtolower($page->action))) {
					case 'add' :

						$this->debug_output('EDIT_PAGESWIKI:     Trying to add a new pageWiki.');
						$pageadd = $page;
						$pageadd->userid = $this->get_my_id($client, $sesskey);
						$pageadd->created = time();
						$pageadd->lastmodified = time();

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
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

						break;
					case 'update' :
						$rpage->error = "EDIT_PAGESWIKI:     Operation Update was not implemented yet";
						break;
					case 'delete' :
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.

		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_LABEL_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
		  return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.

		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_FORUM_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.

		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $course->id)) {
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
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
		  return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		/// These database operations MIGHT throw an HTML error message,
		/// so we've got to catch that and send it back in an error
		/// request.

		/// Check for correct permissions.
		if (!$this->has_capability('moodle/category:manage', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		/// Check for correct permissions.
		if (!$this->has_capability('moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		/// Check for correct permissions.
		if (!$this->has_capability('moodle/category:managegroups', CONTEXT_SYSTEM, 0)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_WIKI_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capability($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_DATABASE_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		//get the section record
		if (!($section = get_record('course_sections', 'id', $sectionid))) {
			return $this->error("AFFECT_ASSIGNMENT_TO_SECTION:     Error finding the section with id=$sectionid");
		}
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}

		//we verify if we have the permission to do this operation
		if (!$cm = get_coursemodule_from_instance('wiki', $wikiid)) {
			return $this->error("Course Module ID was not found. We can't verify if you have permission to do this operation");
		}
		if (!$this->has_capability('mod/wiki:participate', CONTEXT_MODULE, $cm->id)) {
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

		//if it isn't specified the role name, this will be set as Student
		$rolename = empty ($rolename) ? "Student" : $rolename;
		$res = $this->affect_role_incourse($client, $sesskey, $rolename, $courseid, 'id', array (
			$userid
		), 'id', true);

		$r = new stdClass();
		$r->status = empty ($res->error);
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

		//if it isn't specified the role name, this will be set as Student
		$rolename = empty ($rolename) ? "Student" : $rolename;
		$res = $this->affect_role_incourse($client, $sesskey, $rolename, $courseid, 'id', array (
			$userid
		), 'id', false);

		$r = new stdClass();
		$r->status = empty ($res->error);
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
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
		  return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($res = get_records('wiki', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = filter_wikis($client, $res);
		}
		return $ret;
	}
	function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, 'get_all_pagesWiki')) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($res = get_records('wiki_pages', $fieldname, $fieldvalue, 'pagename', '*')) {
			$ret = filter_pagesWiki($client, $res);
		}
		return $ret;
	}
	function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($res = get_records('groups', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = filter_groups($client, $res);
		}
		return $ret;
	}
	function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($forums = get_records("forum", $fieldname, $fieldvalue, "name")) {
			$ret = filter_forums($client, $forums);
		}
		return $ret;
	}
	function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
	         return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($labels = get_records("label", $fieldname, $fieldvalue, "name")) {
			$ret = filter_labels($client, $labels);
		}
		return $ret;
	}
	function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($assignments = get_records("assignment", $fieldname, $fieldvalue, "name")) {
			$ret = filter_assignments($client, $assignments);
		}
		return $ret;
	}
	function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'wspp'));
		}
		$ret = array ();
		if ($databases = get_records("data", $fieldname, $fieldvalue, "name")) {
			$ret = filter_databases($client, $databases);
		}
		return $ret;
	}

	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 END LILLE FUNCTIONS                                                       *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/

}
?>
