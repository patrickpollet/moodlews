<?php


// $Id: server.class.php,v 1.5.4 2007/05/02 04:05:36 ppollet Exp $
/**
 * Base class for web services server layer. PP 5 ONLY.
 *
 * @package Web Services
 * @version $Id: server.class.php,v 1.5 2007/04//26 04:05:36 ppollet Exp $
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca> v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5, v 1.6, v 1.7
 * @author
 */
/* rev history
 @see revisions.txt
**/

require_once ('../config.php');
require_once ('wslib.php');
require_once ('filterlib.php');
/// increase memory limit (PHP 5.2 does different calculation, we need more memory now)
// j'ai 11000 comptes
@ raise_memory_limit("192M"); //fonction de lib/setuplib.php incluse via config.php
//set_time_limit(0);
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
	var $version = 2010101000; // also Moodle 2.0  compatible
	var $using17;
	var $using19 = false;
	/**
	 * Constructor method.
	 *
	 * @uses $CFG
	 * @param none
	 * @return none
	 */
	function server () {
		global $CFG;
		$this->debug_output("Server init...");
		$this->debug_output('    Version: ' . $this->version);
        $this->debug_output('    Session Timeout: ' . $this->sessiontimeout);
		
		
		if (! $CFG->wspp_using_moodle20) { 
			$this->using17 = file_exists($CFG->libdir . '/accesslib.php');
			$this->using19 = file_exists($CFG->libdir . '/grouplib.php');
			//Check for any DB upgrades.
			if (empty ($CFG->webservices_version)) {
				$this->upgrade(0);
			} else
				if ($CFG->webservices_version < $this->version) {
					$this->upgrade($CFG->webservices_version);
				}
		} else {
			$this->using17 = $this->using19 = true; 
		}
		// setup default values if not set in admin screens (see admin/wspp.php)
		if (empty ($CFG->ws_sessiontimeout))
			$CFG->ws_sessiontimeout = 1800;
		$this->sessiontimeout = $CFG->ws_sessiontimeout;

		if (!isset ($CFG->ws_logoperations))
			$CFG->ws_logoperations = 1;
		if (!isset ($CFG->ws_logerrors))
			$CFG->ws_logerrors = 0;
		if (!isset ($CFG->ws_logdetailedoperations))
			$CFG->ws_logdetailledoperations = 0;
		if (!isset ($CFG->ws_debug))
			$CFG->ws_debug = 0;
        if (!isset ($CFG->ws_enforceipcheck))
            $CFG->ws_enforceipcheck = 0; // rev 1.6.1 off by default++++
	}
	/**
	 * Performs an upgrade of the webservices system.
	 *  Moodle < 2.0 ONLY 
	 * @uses $CFG
	 * @param int $oldversion The old version number we are upgrading from.
	 * @return boolean True if successful, False otherwise.
	 */
	private function upgrade($oldversion) {
		global $CFG;
		
		if ($CFG->wspp_using_moodle20)
			return $this->error(get_string('ws_not_installed_moodle20', 'local_wspp'));
		
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
	private function add_session_key() {
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
	private function validate_client($client = 0, $sesskey = '', $operation = '') {
		global $USER, $CFG;
		
		//return true;

		 // rev 1.6.3 added extra securityu checks
		 $client  = clean_param($client, PARAM_INT);
         $sesskey = clean_param($sesskey, PARAM_ALPHANUM);

		/// We can't validate a session that hasn't even been initialized yet.
		if (!$sess = ws_get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
			return false;
		}
		/// Validate this session.
		if ($sesskey != $sess->sessionkey) {
			return false;
		}

		// rev 1.6 make sure the session has not timed out
		if ($sess->sessionbegin + $this->sessiontimeout < time()) {
			$sess->sessionend = time();
			ws_update_record('webservices_sessions', $sess);
			return false;
		}

		$USER->id = $sess->userid;
		$USER->username = '';
		$USER->mnethostid = $CFG->mnet_localhost_id; //Moodle 1.95+ build sept 2009
        $USER->ip= getremoteaddr();
		unset ($USER->access); // important for get_my_courses !
		$this->debug_output("validate_client OK $operation $client user=" . print_r($USER, true));

        //$this->debug_output(print_r($CFG,true));

		//LOG INTO MOODLE'S LOG
		if ($operation && $CFG->ws_logoperations)
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
	protected function error($msg) {
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
	 * @param string $output Debugging output.
	 * @return void
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
     * @param int $userid : user to chcek, default me
	 */
	private function has_capability($capability, $context_type, $instance_id,$userid=NULL) {
		global $USER;
		$context = get_context_instance($context_type, $instance_id);
		if (empty($userid)) { // we must accept null, 0, '0', '' etc. in $userid
			$userid = $USER->id;
		}
		return has_capability($capability, $context, $userid);
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
			return $this->error(get_string('ws_accessdisabled', 'local_wspp'));
		if (!$this->using17)
			return $this->error(get_string('ws_nomoodle16', 'local_wspp'));

         $userip = getremoteaddr(); // rev 1.5.4
         if (!empty($CFG->ws_enforceipcheck)) {
            if (!record_exists('webservices_clients_allow','client',$userip))
            return $this->error(get_string('ws_accessrestricted', 'local_wspp',$userip));

         }

         // rev 1.6.3 added extra security checks
         $username = clean_param($username, PARAM_NOTAGS);
         $password = clean_param($password, PARAM_NOTAGS);

		/// Use Moodle authentication.
		/// FIRST make sure user exists , otherwise account WILL be created with CAS authentification ....
		if (!$knownuser = ws_get_record('user', 'username', $username)) {
			return $this->error(get_string('ws_invaliduser', 'local_wspp'));
		}
		//$this->debug_output(print_r($knownuser, true));
		

		$user=false;

		//revision 1.6.1 try to use a custom auth plugin
        if (!exists_auth_plugin("webservice") || ! is_enabled_auth("webservice")) {
$this->debug_output('internal ');
			/// also make sure internal_authentication is used  (a limitation to fix ...)
			if (!is_internal_auth($knownuser->auth)) {
				return $this->error(get_string('ws_invaliduser', 'local_wspp'));
			}
            // regular manual authentification (should not be allowed !)
			$user = authenticate_user_login(addslashes($username), $password);
			$this->debug_output('return of a_u_l'. print_r($user,true));


		}
		else {
			$this->debug_output('auth plugin');
			$auth=get_auth_plugin("webservice");
			if ($auth->user_login_webservice($username,$password)) {
				$user=$knownuser;
			}
        }

        if (($user === false) || ($user && $user->id == 0) || isguestuser($user)) {

			return $this->error(get_string('ws_invaliduser', 'local_wspp'));
		}
		
		//$this->debug_output(print_r($user,true));
		/// Verify that an active session does not already exist for this user.
		$userip = getremoteaddr(); // rev 1.5.4

		$sql = "userid = {$user->id} AND verified = 1 AND
                            ip='$userip' AND sessionend = 0 AND
							(" . time() . "- sessionbegin) < " . $this->sessiontimeout;
		
		//$this->debug_output($sql);
		if ($sess = ws_get_record_select('webservices_sessions',$sql)) {
			//return $this->error('A session already exists for this user (' . $user->login . ')');
            /*
			if ($sess->ip != $userip)
				return $this->error(get_string('ws_ipadressmismatch', 'local_wspp',$userip."!=".$sess->ip));
            */
            //give him more time 
            ws_set_field('webservices_sessions','sessionbegin',time(),'id',$sess->id);
			// V1.6 reuse current session
		} else {
			$this->debug_output('nouvelle session ');
			/// Login valid, create a new session record for this client.
			$sess = new stdClass;
			$sess->userid = $user->id;
			$sess->verified = true;
			$sess->ip = $userip;
			$sess->sessionbegin = time();
			$sess->sessionend = 0;
			$sess->sessionkey = $this->add_session_key();
			if ($sess->id = ws_insert_record('webservices_sessions', $sess)) {
				if ($CFG->ws_logoperations)
					add_to_log(SITEID, 'webservice', 'webservice pp', '', __FUNCTION__);
			} else
				return $this->error(get_string('ws_errorregistersession','local_wspp'));

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
                global $CFG;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if ($sess = ws_get_record('webservices_sessions', 'id', $client, 'sessionend', 0, 'verified', 1)) {
			$sess->verified = 0;
			$sess->sessionend = time();
			if (ws_update_record('webservices_sessions', $sess)) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	function get_version($client, $sesskey) {
		global $CFG;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return -1; //invalid Moodle's ID
		}
		return $this->version;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		/// Verify that the user for this session can perform this operation.
		//nothing to check user database is public ?
		$ret = array (); // Return array.
		if (empty ($userids)) { // all users ...
			return filter_users($client, get_users(true), 0);
		}
		foreach ($userids as $userid) {
			$users = ws_get_records('user', $idfield, $userid); //may have more than one !
			if (empty ($users)) {
				$a = new StdClass();
				$a->critere = $idfield;
				$a->valeur = $userid;
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			// all courses wanted
			$res = ws_get_records('course', '', '');
			return filter_courses($client, $res);
		}
		foreach ($courseids as $courseid) {
			if ($courses = ws_get_records('course', $idfield, $courseid)) { //may have more than one
				$ret = array_merge($ret, $courses);
			} else {
				$a = new StdClass();
				$a->critere = $idfield;
				$a->valeur = $courseid;
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
			}
		}

		return filter_courses($client,$ret);
	}


	function get_courses_search($client, $sesskey, $search) {
    	global $USER;
    	if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
        	return $this->error(get_string('ws_invalidclient', 'local_wspp'));
    	}
    	$search = trim(strip_tags($search)); // trim & clean raw searched string

    	if (empty ($search)) {
        	// all courses wanted
        	$res = ws_get_records('course', '', '');
        	return filter_courses($client, $res);
    	}

    	$searchterms = explode(" ", $search);    // Search for words independently
    	foreach ($searchterms as $key => $searchterm) {
        	if (strlen($searchterm) < 2) {
            	unset($searchterms[$key]);
        	}
    	}
        $totalcount=0;
    	$ret = get_courses_search($searchterms, "fullname ASC",0,9999,$totalcount);
    	return filter_courses($client,$ret);
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
		  $courses = ws_get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = ws_get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			$courses = ws_get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = ws_get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
				}
			}
		}
		//remove courses not available to current user
		$courses = filter_courses($client, $courses);
		foreach ($courses as $course) {
			if ($CFG->wspp_using_moodle20)
				require_once ($CFG->dirroot.'/course/lib.php');
				
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if (empty($type)) {
			return $this->error(get_string('ws_emptyparameter', 'local_wspp','type'));
		}
		$ret = array ();
		if (empty ($courseids)) {
			$courses = ws_get_my_courses($USER->id);
		} else {
			$courses = array ();
			foreach ($courseids as $courseid) {
				if ($course = ws_get_record('course', $idfield, $courseid))
					$courses[] = $course;
				else {
					//append an error record to the list
					$a = new StdClass();
					$a->critere = $idfield;
					$a->valeur = $courseid;
					$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
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
				$ret[] = $this->non_fatal_error(get_string('ws_nomatch', 'local_wspp', $a));
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
        if (empty ($courseids))
            return server :: get_user_grades($client, $sesskey, $userid, $useridfield);


         if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'local_wspp'));

        require_once ($CFG->dirroot . '/grade/lib.php');
        require_once ($CFG->dirroot . '/grade/querylib.php');

		if (!$user = ws_get_record('user', $useridfield, $userid)) {
			return $this->error(get_string('ws_userunknown','local_wspp',$userid));
		}
		$return = array ();
		/// Find grade data for the requested IDs.
		foreach ($courseids as $cid) {
			$rgrade = new stdClass;
			/// Get the student grades for each course requested.
			if ($course = ws_get_record('course', $courseidfield, $cid)) {
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
						$rgrade->error = get_string('ws_nogrades','local_wspp',$a);
					}
				} else {
					$rgrade->error= get_string('ws_noseegrades','local_wspp',$course->fullname);
				}
			} else {
				$rgrade->error = get_string('ws_courseunknown','local_wspp', $cid);
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
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'local_wspp'));

        if (!$user = ws_get_record('user', $idfield, $userid)) {
			return $this->error(get_string('ws_userunknown','local_wspp',$idfield.'='.$userid));
		}
		// we cannot call  API grade_get_course_grade($user->id) since it does not set the courseid as we want it
		if (!$courses = ws_get_my_courses($user->id, $sort = 'sortorder ASC', $fields = 'idnumber')) {
			return $this->error(get_string('ws_nocourseforuser','local_wspp',$userid));
		}
		$courseids = array ();
		foreach ($courses as $c)
			if (!empty ($c->idnumber))
				$courseids[] = $c->idnumber;
		//$this->debug_output("GUG=" . print_r($courseids, true));

		if (empty ($courseids))
			return $this->error(get_string('ws_nocoursewithidnumberforuser','local_wspp', $userid));
		// caution not $this->get_user_grades THAT WILL call mdl_sopaserver::get_grades
		// resulting in two calls of to_soaparray !!!!
		return server :: get_grades($client, $sesskey, $userid, $idfield, $courseids, 'idnumber');
	}

	public function get_course_grades($client, $sesskey, $courseid, $idfield = "idnumber") {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}

         if (!$this->using19)
            return $this->error(get_string(' ws_notsupportedgradebook', 'local_wspp'));

        require_once ($CFG->dirroot . '/grade/lib.php');
        require_once ($CFG->dirroot . '/grade/querylib.php');

		$return = array ();
		//Get all student grades for course requested.
		if ($course = ws_get_record('course', $idfield, $courseid)) {
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
                        $rgrade=new StdClass();
                        $rgrade->error = get_string('ws_nogrades','local_wspp',$a);
                        $return[] = $rgrade;
					}
				}
			} else {
                 $rgrade=new StdClass();
				$rgrade->error = get_string('ws_noseegrades','local_wspp',$course->fullname);
				$return[] = $rgrade;
			}
		} else {
             $rgrade=new StdClass();
			$rgrade->error = get_string('ws_courseunknown','local_wspp', $courseid);
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		// convert user request criteria to an userid
		$user = ws_get_record('user', $useridfield, $userid);
		if (!$user)
			return $this->error(get_string('ws_userunknown','local_wspp',$useridfield."=".$userid));
		$userid = $user->id;
		// convert course request criteria to a courseid
		$course = ws_get_record('course', $courseidfield, $courseid);
		if (!$course)
			return $this->error(get_string('ws_courseunknown','local_wspp',$courseidfield."=".$courseid ));
		return ws_get_primaryrole_incourse($course, $userid);
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
		global $CFG,$USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp')." ".__FUNCTION__);
		}
		$cuid = $USER->id;
		if (!empty($uinfo)) {
			// find userid if not current user
				if (!$user = ws_get_record('user', $idfield, $uinfo))
					return $this->error(get_string('ws_userunknown','local_wspp',idfield."=".$uinfo));
                $uid=$user->id;
		} else
			$uid = $cuid; //use current user and ignore $idfield
		//only admin user can request courses for others
		if ($uid != $cuid) {
			if (!$this->has_capability('moodle/user:loginas', CONTEXT_SYSTEM, 0)) {
				return $this->error(get_string('ws_operationnotallowed','local_wspp'));
			}
		}

		$sort = $sort ? $sort : 'fullname';
		if (isguestuser($user))
			$res = ws_get_records('course', 'guest', 1, $sort);
		else {
           //Moodle 1.95 do not return all fields set in wsdl
           if (!$CFG->wspp_using_moodle20)
           $extrafields="password,summary,format,showgrades,newsitems,enrolperiod,numsections,marker,maxbytes,
hiddensections,lang,theme,cost,timecreated,timemodified,metacourse";
			else 
			// some fields are not anymore defined in Moodle 2.0
			$extrafields="summary,format,showgrades,newsitems,numsections,marker,maxbytes,
hiddensections,lang,theme,timecreated,timemodified";

			$res = ws_get_my_courses($uid, $sort,$extrafields);
        }
		if ($res) {
		   //rev 1.6 return primary role for each course
             foreach ($res as $id=>$value)
                   $res[$id]->myrole= ws_get_primaryrole_incourse($res[$id],$uid);
             //return $res;
             return filter_courses($client, $res);
        }
		else
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
	}

/**
 * returns users having $idrole in course identified by $idcourse
 * @param string $idcourse unique identifierr of course
 * @param string $idfield  name of field used to finc course (idnumber, id, shortname), should be unique
 * @param integer $idrole  role searched for (0 = any role)
 */

	function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole = 0) {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if (!$course = ws_get_record('course', $idfield, $idcourse)) {
			return $this->error(get_string('ws_courseunknown','local_wspp',$idfield."=".$idcourse ));
		}
		if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $course->id)
		 && !ws_is_enrolled($course->id,$USER->id))
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));

		if (!empty ($roleid) && !ws_record_exists('role', 'id', $idrole))
            return $this->error(get_string('ws_roleunknown','local_wspp',$idrole ));
		$context = get_context_instance(CONTEXT_COURSE, $course->id);
		if ($res = get_role_users($idrole, $context, true, '')) {
            //rev 1.6 if $idrole is empty return primary role for each user
            if (empty($idrole)) {
                foreach ($res as $id=>$value)
                    $res[$id]->role=ws_get_primaryrole_incourse($course,$res[$id]->id);
            }


			return filter_users($client, $res, $idrole);
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
		}
	}

	function get_roles($client, $sesskey, $roleid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		// Get a list of all the roles in the database, sorted by their short names.
		if ($res = ws_get_records('role', $idfield, $roleid, 'shortname, id', '*')) {
			return $res;
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
		}
	}

	function get_categories($client, $sesskey, $catid = '', $idfield = '') {
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		// Get a list of all the categories in the database, sorted by their name
		if ($res = ws_get_records('course_categories', $idfield, $catid, 'name', '*')) {
			return filter_categories($client, $res);
		} else {
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
		}
	}

	function get_events($client, $sesskey, $eventtype, $ownerid,$owneridfield='id') {
		global $USER;

		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
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
                if (!$course =ws_get_record('course',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_courseunknown','local_wspp',$owneridfield."=".$ownerid ));
                }
                $ownerid=$course->id;
				break;
			case cal_show_group :
				$idfield = 'groupid';
                if (!$group =ws_get_record('groups',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_groupunknown','local_wspp',$owneridfield."=".$ownerid ));
                }
                 $ownerid=$group->id;
				break;
			case cal_show_user :
				$idfield = 'userid';
                if (!$user =ws_get_record('user',$owneridfield,$ownerid)) {
                    return $this->error(get_string('ws_userunknown','local_wspp',$owneridfield."=".$ownerid ));
                }
                 $ownerid=$user->id;
				break;
			default :
				$idfield = '';
				$ownerid = '';
		}
		if ($res = ws_get_records('event', $idfield, $ownerid)) {
			foreach ($res as $r) {
				$r = filter_event($client, $eventtype, $r);
				if ($r)
					$ret[] = $r;
			}
		} else {
			$ret[]=$this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
		}

		return $ret;
	}

	function get_group_members($client, $sesskey, $groupid,$groupidfield='id') {
		global $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if (!$group = ws_get_record('groups', $groupidfield, $groupid)) {
			return $this->error(get_string('ws_groupunknown','local_wspp',$groupid));
		}

		if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $group->courseid)
		    && ! ws_is_enrolled($group->courseid,$USER->id))
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		//$res = get_group_users($group->id);   deprecated Moodle 1.9 removed Moodle 2.0
		$res=groups_get_members($group->id);
		if (!$res)
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
		return filter_users($client, $res, 0);
	}

    function get_grouping_members($client, $sesskey, $groupid,$groupidfield='id') {
    	global $USER;
        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        if (!$group = ws_get_record('groupings', $groupidfield, $groupid)) {
            return $this->error(get_string('ws_groupingunknown','local_wspp',$groupid));
        }

        if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $group->courseid)
          && ! ws_is_enrolled($group->courseid,$USER->id))
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        $res = groups_get_grouping_members($group->id);
        if (!$res)
            return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
        return filter_users($client, $res, 0);
    }


    protected function get_groups($client, $sesskey,$groups,$idfield,$courseid){

	    if (empty($groups) && $courseid) {
		    return server::get_groups_bycourse ($client,$sesskey,$courseid);
	    }
	    if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
		    return $this->error(get_string('ws_invalidclient', 'local_wspp'));
	    }

	    global $CFG;
	    $ret = array();
	    if ($courseid) {
		    $courseselect = 'AND g.courseid ='.$courseid ;
	    } else {
		    $courselect = '';
	    }

	    foreach ($groups as $group) {
		    $sql= "$idfield ='$group' $courseselect ";

		    if ($g = ws_get_records_select('groups',$sql)) {
			    $g=filter_groups($client,$g);
			    foreach($g as $one) {
				    $ret[] = $one;
			    }

		    } else {
			    $ret[]=$this->non_fatal_error(get_string('nogroups','local_wspp')); // "Invalid group $idfield :$group ");
		    }
	    }

	    return $ret;
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
    	global $CFG;

        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
            
        }

        if (!$group = ws_get_record('groups', 'id', $groupid)) {
            return $this->error(get_string('ws_groupunknown','local_wspp','id='.$groupid));
        }
        	/// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $group->courseid)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }

        if (!$user = ws_get_record("user", "id", $userid)) {
            return $this->error(get_string('ws_userunknown','local_wspp','id='.$userid));
        }

            /// Check user is enroled in course
          if (!ws_is_enrolled( $group->courseid, $user->id)) {
            $a=new StdClass();
            $a->user=$user->username;
            $a->course=$group->courseid;
            return $this->error(get_string('ws_user_notenroled','local_wspp',$a));
        }
        
        if ($CFG->wspp_using_moodle20) {
        	// not anymore included by defualt in Moodle 2.0
        	require_once ($CFG->dirroot.'/group/lib.php');
        }

        
        $resp = new stdClass();
        $resp->status = groups_add_member($group->id, $user->id);
        return $resp;
    }

    function remove_user_from_group($client, $sesskey, $userid, $groupid) {
		global $CFG;
		
        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        if (!$group = ws_get_record('groups', 'id', $groupid)) {
            return $this->error(get_string('ws_groupunknown','local_wspp','id='.$groupid));
        }
        
         /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $group->courseid)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }
        

        if (!$user = ws_get_record("user", "id", $userid)) {
            return $this->error(get_string('ws_userunknown','local_wspp','id='.$userid));
        }

            /// Check user is member
        if (!ws_is_enrolled( $group->courseid, $user->id)) {
            $a=new StdClass();
            $a->user=$user->username;
            $a->course=$group->courseid;
            return $this->error(get_string('ws_user_notenroled','local_wspp',$a));
        }

 
          if ($CFG->wspp_using_moodle20) {
        	// not anymore included by defualt in Moodle 2.0
        	require_once ($CFG->dirroot.'/group/lib.php');
        }
        $resp = new stdClass();
        $resp->status = groups_remove_member($group->id, $user->id);
        return $resp;
    }



     function affect_group_to_grouping($client, $sesskey, $groupid, $groupingid) {
     	global $CFG;
         if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        if (!$group = ws_get_record('groups', 'id', $groupid)) {
            return $this->error(get_string('ws_groupunknown','local_wspp','id='.$groupid));
        }
        if (!$grouping = ws_get_record('groupings', 'id', $groupingid)) {
            return $this->error(get_string('ws_groupidunknown','local_wspp','id='.$groupid));
        }
        if ($group->courseid != $grouping->courseid) {
             $a=new StdClass();
            $a->group=$group->id;
            $a->grouping=$grouping->id;
            return $this->error(get_string('ws_group_grouping_notsamecourse','local_wspp',$a));
        }
         /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $group->courseid)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }
        
           if ($CFG->wspp_using_moodle20) {
        	// not anymore included by defualt in Moodle 2.0
        	require_once ($CFG->dirroot.'/group/lib.php');
        }
        $resp = new stdClass();
        $resp->status = groups_assign_grouping($grouping->id, $group->id);
        return $resp;


    }

     function remove_group_from_grouping($client, $sesskey, $groupid, $groupingid) {
     		global $CFG;
             if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        if (!$group = ws_get_record('groups', 'id', $groupid)) {
            return $this->error(get_string('ws_groupunknown','local_wspp','id='.$groupid));
        }
        if (!$grouping = ws_get_record('groupings', 'id', $groupingid)) {
            return $this->error(get_string('ws_groupidunknown','local_wspp','id='.$groupid));
        }
        if ($group->courseid != $grouping->courseid) {
             $a=new StdClass();
            $a->group=$group->id;
            $a->grouping=$grouping->id;
            return $this->error(get_string('ws_group_grouping_notsamecourse','local_wspp',$a));
        }
         /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $group->courseid)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }
        //$this->debug_output("RGG  gid=$group->id gpip= $grouping->id");
        
        if ($CFG->wspp_using_moodle20) {
	        // not anymore included by defualt in Moodle 2.0
	        require_once ($CFG->dirroot.'/group/lib.php');
        }
        $resp = new stdClass();
        $resp->status = groups_unassign_grouping($grouping->id, $group->id);
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
    function affect_group_to_course($client, $sesskey, $groupid, $courseid,$idfield='id') {

        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        if (!$course = ws_get_record('course', $idfield, $courseid)) {
            return $this->error(get_string('ws_courseunknown','local_wspp',"id=".$courseid ));
        }

        /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $course->id)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }

        //verify if this grup exists
        if (!$group = ws_get_record('groups', 'id', $groupid)) {
            return $this->error(get_string('ws_groupunknown','local_wspp','id='.$groupid));
        }

        //verify if this group is assigned of any course
        if ($group->courseid > 0) {
            $a=new StdClass();
            $a->group=$group->id;
            $a->course=$groupe->courseid;
            return $this->error("ws_groupalreadyaffected","wspp",$a);
        }
        $group->courseid = $courseid;
        //verify if the update operation is done


        $resp = new stdClass();
        $resp->status = ws_update_record('groups', $group);
        return $resp;
    }



    function affect_grouping_to_course($client, $sesskey, $groupid, $courseid,$idfield='id') {
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

        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        if (!$course = ws_get_record('course', $idfield, $courseid)) {
            return $this->error(get_string('ws_courseunknown','local_wspp',"id=".$courseid ));
        }

        /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $course->id)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }

        //verify if this grup exists
        if (!$group = ws_get_record('groupings', 'id', $groupid)) {
            return $this->error(get_string('ws_groupingunknown','local_wspp','id='.$groupid));
        }

        //verify if this group is assigned of any course
        if ($group->courseid > 0) {
            $a=new StdClass();
            $a->group=$group->id;
            $a->course=$groupe->courseid;
            return $this->error("ws_groupingalreadyaffected","wspp",$a);
        }


        $resp = new stdClass();
        $resp->status =ws_update_record('groupings', $group);
        return $resp;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if (!$course = ws_get_record('course', $idfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','local_wspp',$idfield."=".$courseid ));
		}
		if (! $this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $course->id))
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));	
		// deprecated in Moodle 1.9
		// gone in Moodle 2.0
		//$res = get_groups($course->id);
		$res=groups_get_all_groups($course->id);
		if (!$res)
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$cuid = $USER->id;
		if (!empty($uinfo)) {
			 // find userid if not current user
				if (!$user = ws_get_record('user', $idfield, $uinfo))
					return $this->error(get_string('ws_userunknown','local_wspp',$idfield."=".$uinfo));
				$uid = $user->id;
		} else
			$uid = $cuid; //use current user and ignore $idfield
		//only an user that can login as another can request  for others
		if ($uid != $cuid) {
			if (!$this->has_capability('moodle/user:loginas', CONTEXT_SYSTEM, 0)) {
				return $this->error(get_string('ws_operationnotallowed','local_wspp'));
			}
		}
		if ($CFG->wspp_using_moodle20)
			$from=" {groups} g,{groups_members} m" ;
		else 
			$from="{$CFG->prefix}groups g,{$CFG->prefix}groups_members m";	
		$sql = "SELECT g.* " .
			"FROM $from
		     WHERE g.id = m.groupid
			 AND m.userid = '$uid'
			 ORDER BY name ASC";
		$res = ws_get_records_sql($sql);
		return filter_groups($client, $res);
	}

	function get_last_changes($client, $sesskey, $courseid, $idfield = 'idnumber', $limit = 10) {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		if (!$course = ws_get_record('course', $idfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','local_wspp',$idfield."=".$courseid ));
		}
		$cuid = $USER->id;
		$isTeacher = $this->has_capability("moodle/course:update", CONTEXT_COURSE, $course->id);
        $fmtdate=get_string('ws_sqlstrftimedatetime','local_wspp'); // '%d/%m/%Y %H:%i:%s'
        //$this->debug_output('date='.$fmtdate);

		//must have id as first field for proper array indexing !
		$sqlAct =<<<EOS
		SELECT DISTINCT {$CFG->prefix}log.id,module, {$CFG->prefix}log.url, info,
time,firstname,lastname,email,
		action , cmid, course, time, FROM_UNIXTIME( time, '$fmtdate' ) AS DATE_J
		FROM {$CFG->prefix}log inner join {$CFG->prefix}user on
{$CFG->prefix}log.userid={$CFG->prefix}user.id
		WHERE course =$course->id
		and (action like 'add%' or action like 'update%')
		and cmid <>0
		and module <>'label'
		ORDER BY time DESC
EOS;
		$return = array ();
        //$this->debug_output($sqlAct);
		if (!$resultAct = get_records_sql($sqlAct)) {
			return $this->non_fatal_error(get_string('ws_nothingfound','local_wspp'));
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
		global $USER,$CFG;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		//resolve user criteria to an user  Moodle's id
		if (!$user = ws_get_record('user', $useridfield, $userid)) {
			return $this->error(get_string('ws_userunknown','local_wspp',$useridfield."=".$userid));
		}
		$cuid = $USER->id;
		if ($courseid) {
			//resolve course criteria to a course Moodle's id
			if (!$course = ws_get_record('course', $courseidfield, $courseid))
				return $this->error(get_string('ws_courseunknown','local_wspp',$courseidfield."=".$courseid ));
			$sql_course = " AND  l.course=$course->id ";
			$canRead = $this->has_capability('coursereport/log:view', CONTEXT_COURSE, $course->id);
		} else {
			$sql_course = '';
			$canRead = $this->has_capability('coursereport/log:view', CONTEXT_SYSTEM, 0);
		}
		if (($cuid != $user->id) && !$canRead) {
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}
		if ($doCount) // caution result MUST have some id value to fetch result later
			$sql_select = " SELECT 1,count(l.userid) as CPT ";
		else {
            $fmtdate=get_string('ws_sqlstrftimedatetime','local_wspp'); // '%d/%m/%Y %H:%i:%s'
			$sql_select =<<<EOS

SELECT l.*,u.auth,u.firstname,u.lastname,u.email,
u.firstaccess, u.lastaccess, u.lastlogin, u.currentlogin,
FROM_UNIXTIME(l.time,'$fmtdate' )as DATE,
FROM_UNIXTIME(u.lastaccess,'$fmtdate' )as DLA,
FROM_UNIXTIME(u.firstaccess,'$fmtdate' )as DFA,
FROM_UNIXTIME(u.lastlogin,'$fmtdate' )as DLL,
FROM_UNIXTIME(u.currentlogin,'$fmtdate' )as DCL
EOS;
		}
		$sql =<<<EOSS
$sql_select
FROM {$CFG->prefix}log l , {$CFG->prefix}user u
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
	 * added rev 1.6.2
	 */
	function get_assignment_submissions ($client,$sesskey,$assignmentid,$userids=array(),$useridfield='idnumber',$timemodified=0,$zipfiles=1) {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		//get the assignment record
		if (!$assignment = ws_get_record("assignment", "id", $assignmentid)) {
			return $this->error(get_string('ws_assignmentunknown','local_wspp','id='.$assignmentid));
		}
		/// Check for correct permissions.
		if (!$this->has_capability('mod/assignment:grade', CONTEXT_COURSE, $assignment->course)) {
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}

		//set up all required variables any error is fatal

		if (!$course = ws_get_record("course", "id", $assignment->course))
			return $this->error(get_string('ws_databaseinconsistent','local_wspp'));

		if (!$cm = get_coursemodule_from_instance("assignment", $assignment->id, $course->id))
			return $this->error(get_string('ws_databaseinconsistent','local_wspp'));

		if( !$context = get_context_instance(CONTEXT_COURSE, $assignment->course))
			return $this->error(get_string('ws_databaseinconsistent','local_wspp'));


		$ret=array();

		//champs a envoyer à la PF
		$fields='u.id, u.username,u.idnumber, u.email';
		$roleid=5; //students

		$moodleUserIds=array();
		if (!empty($userids)) {
			foreach ($userids as $userid) {
                //$this->debug_output($userid.' '.$useridfield);
                //caution :  alias u is not set in ws_get_record, so add it !!!
				if ($user=ws_get_record('user u',$useridfield,$userid,'','','','',$fields)) {
					$moodleUserIds[$user->id]=$user;
                   // $this->debug_output(print_r($user,true));
                }
			}

		}else {
			/// Get all existing participants in this context.
			if ($cm->groupingid==0 || !$cm->groupmembersonly)
				$moodleUserIds = get_role_users($roleid, $context, false,$fields);
			else
				$moodleUserIds=groups_get_grouping_members($cm->groupingid,$fields);
		}
         //$this->debug_output(print_r($moodleUserIds,true));
        require_once($CFG->libdir.'/filelib.php');
		require_once("$CFG->dirroot/mod/assignment/lib.php");
		require_once("$CFG->dirroot/mod/assignment/type/$assignment->assignmenttype/assignment.class.php");
		$assignmentclass = "assignment_$assignment->assignmenttype";
		$assignmentinstance = new $assignmentclass($cm->id, $assignment, $cm, $course);

		foreach($moodleUserIds as $studentid=>$student) {
			//  Get the submission for this student
			$submission = $assignmentinstance->get_submission($studentid);
			if($submission && $submission->timemodified > $timemodified) {
				$submission->useridnumber=$student->idnumber;
                $submission->userusername=$student->username;
                $submission->useremail=$student->email;
                //if upload of uploadsingle, submissions are in files
                //if online, submission is in data1
                $submission->assignmenttype=$assignment->assignmenttype;
                $submission->files=array();
				//collect file(s)
                if ($basedir = $assignmentinstance->file_area_name($studentid)) {
                    $basedir=$CFG->dataroot.'/'.$basedir;
                   if ($files = get_directory_list($basedir,'',true,false,true)) {
                   $numfiles=0;
                  foreach ($files as $key => $value) {
                         $file=new fileRecord();
                         $file->setFilename($value);
                         $file->setFilePath($basedir);
                         $file->setFileurl(get_file_url("$basedir/$value", array('forcedownload'=>1)));
                         if ($binary = file_get_contents("$basedir/$value")) {
                             $file->setFilecontent(base64_encode( $binary ));
                             $file->setFilesize(strlen($binary));
                             $numfiles++;
                        }else {
                             $file->setFilecontent('');
                             $file->setFilesize(0);
                         }
                         $submission->files[]=$file;
                     }
                     //for some reasons this field is 0 in table mdl_assignment_submissions
                     $submission->numfiles=$numfiles;
                   }
                }
				$ret[]=$submission;
			}
        }

		return $ret;

	}



	/**
	 * Enrol users with the given role name  in the given course
	 *
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
     * @param string $rolename  shortname of role to affect
	 * @param string $courseid The course ID number to enrol students in <- changed to category...
     * @param  string $courseidfield field to use to identify course (idnumber,id, shortname)
	 * @param array $userids An array of input user idnumber values for enrolment.
	 * @param string $idfield identifier used for users . Note that $courseid is expected
	 *    to contains an idnumber and not Moodle id.
	 * @return array Return data (user_student records) to be converted into a
	 *               specific data format for sending to the client.
	 */
	function affect_role_incourse($client, $sesskey, $rolename, $courseid, $courseidfield, $userids, $useridfield = 'idnumber', $enrol = true) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		global $CFG, $USER;

		if (!($role = ws_get_record('role', 'shortname', $rolename))) {
            return $this->error(get_string('ws_roleunknown','local_wspp',$rolename));
		}

		//$groupid = 0; // for the role_assign function (what does this ? not anymore in Moodle 2.0
		if (!$course = ws_get_record('course', $courseidfield, $courseid)) {
			return $this->error(get_string('ws_courseunknown','local_wspp',$courseidfield."=".$courseid ));
		}
		$context = get_context_instance(CONTEXT_COURSE, $course->id);
		if (!has_capability("moodle/role:assign", $context))
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		//not anymore in Moodle 2.0 ...	
		if (!empty($course->enrolperiod)) {
			$timestart = time();
			$timeend = $timestart + $course->enrolperiod;
		} else {
			$timestart = $timeend = 0;
		}
		$this->debug_output("IDS=" . print_r($userids, true) . "\n" . $enrol ."\n ctx=".$context->id);
		$return = array ();
		if (!empty ($userids)) {
			foreach ($userids as $userid) {
				$st = new enrolRecord();
				if (!$leuser = ws_get_record('user', $useridfield, $userid)) {
					$st->error =get_string('ws_userunknown','local_wspp',$useridfield."=".$userid);
				} else {
					$st->userid = $leuser-> $useridfield; //return the sent value
					$st->course = $course-> $courseidfield;
					$st->timestart = $timestart;
					$st->timeend = $timeend;
					if ($enrol) {
						if (!ws_role_assign($role->id, $leuser->id, $context->id, $timestart, $timeend,$course)) {
							$st->error = "error enroling";
							$op = "error enroling " . $st->userid . " to " . $st->course;
						} else {
							$st->enrol = "webservice";
							$op = $rolename . " " . $st->userid . " added to " . $st->course;
						}
					} else {
						if (!ws_role_unassign($role->id, $leuser->id, $context->id,$course)) {
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
			$st->error = get_string('ws_nothingtodo','local_wspp');
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
    *
    * important for consistency with others edit functions, Moodle internal id number is used
    * to identify user to be updated, deleted. see update_user, delete_user ... to use other fields
    * such as idnumber of username
    */
	function edit_users($client, $sesskey, $users) {
		global $CFG, $USER;
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rusers = array ();
		//$this->debug_output('Attempting to update user IDS: ' . print_r($users, true));
		if (!empty ($users)) {
			foreach ($users->users as $user) {
				$ruser = new stdClass();
				//$this->debug_output('traitement de ' . print_r($user, true));
				switch (trim(strtolower($user->action))) {
					case 'add' :
					
						if (!$this->has_capability('moodle/user:create', CONTEXT_SYSTEM, 0)) {
							$ruser->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}
						
						// fix record if needed and check for missing values or database collision
						if ($errmsg=ws_checkuserrecord($user,true)) {
							$ruser->error=$errmsg;
							break;
						}

                        $user->timecreated = time();
                        $user->timemodified = $user->timecreated;
						if ($userid=ws_insert_record('user',$user)) {
							$ruser = ws_get_record('user','id',$userid);
							$this->debug_output('inserion ok'.print_r($ruser,true));
                             events_trigger('user_created', $ruser);

						}else {
							$ruser->error=get_string('ws_errorcreatinguser','local_wspp',$user->idnumber);
							$this->debug_output('insertion KO '.print_r($user,true));
						}
						$this->debug_output('traitement de ' . print_r($ruser, true));
						break;

					case 'update' :
						if (!$this->has_capability('moodle/user:update', CONTEXT_SYSTEM, 0)) {
							$ruser->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}
						if (! $olduser = ws_get_record('user', 'id', $user->id)) {
							$rcourse->error = get_string('ws_userunknown','local_wspp',"id=".$user->id );
							break;
						}
						$ruser=$user;
						// fix record if needed and check for missing values or database collision
						if ($errmsg=ws_checkuserrecord($user,false)) {
							$ruser->error=$errmsg;
							break;
						}
						$user->timemodified = time();

						//GROS PB avec le record rempli de 0 !!!!
						foreach($user as $key=>$value) { // rev 1.5.15 must ignore empty values ! serious flaw !
							if (empty($value)) unset ($user->$key);
						}
						/// Update values in the $user database record with what
						/// the client supplied.

						if (ws_update_record('user', $user)) {
							$ruser = ws_get_record('user', 'id', $user->id);
                            events_trigger('user_updated', $ruser);
						} else {
							$ruser->error=get_string('ws_errorupdatinguser','local_wspp',$user->id);
						}
				break;

				case 'delete' :

					/// Deleting an existing user.
					if (!$this->has_capability('moodle/user:delete', CONTEXT_SYSTEM, 0)) {
						$ruser->error=get_string('ws_operationnotallowed','local_wspp');
						break;
					}

					if (! $user = ws_get_record('user', 'id', $user->id)) {
						$ruser->error = get_string('ws_userunknown','local_wspp',"id=".$user->id );
						break;
					}
				
					$ruser = $user;
					if ($user->deleted) // rev 1.7
						$ruser->error=get_string('ws_erroralreadydeleteduser','local_wspp',$user->id);
					else 
						if (!delete_user($user)) {
						$ruser->error=get_string('ws_errordeletinguser','local_wspp',$user->idnumber);
					}
					break;
                  default :
                        $ruser->error=get_string('ws_invalidaction','local_wspp',$user->action);
			}
			$rusers[] = $ruser;
		}
	}
	return filter_users($client,$rusers,0);
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
     *  * important for consistency with others edit functions, Moodle internal id number is used
    * to identify course to be updated, deleted. see update_course, delete_course ... to use other fields
    * such as idnumber or shortname
	 */
	function edit_courses($client, $sesskey, $courses) {
		global $CFG, $USER;
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
       // $this->debug_output("EDC".print_r($courses,true));
		if (!empty ($courses)) {
			foreach ($courses->courses as $course) {
				$rcourse = new stdClass;
				$rcourse->error="";
                // $this->debug_output("EDC".print_r($course,true));
				switch (trim(strtolower($course->action))) {
					case 'add' :
						/// Adding a new course.
						// fix course record if needed and check for missing values or database collision
						if ($errmsg=ws_checkcourserecord($course,true)) {
							$rcourse->error=$errmsg;
							break;
						}

						/// Now check for correct permissions.
						if (!$this->has_capability("moodle/course:create",CONTEXT_COURSECAT,$course->category)) {
							$rcourse->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}

						if ($courseadd=create_course($course)) {
							$rcourse = $courseadd;

						}else {
							$rcourse->error=get_string('ws_errorcreatingcourse','local_wspp',$course->idnumber);
						}

						break;

					case 'update' :
						/// Updating an existing course.
						if (! $oldcourse = ws_get_record('course', 'id', $course->id)) {
							$rcourse->error = get_string('ws_courseunknown','local_wspp',"idnumber=".$course->id );
							break;
						}
						$rcourse=$course;
						if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE,$oldcourse->id)) {
							$rcourse->error=get_string('ws_operationnotallowed','local_wspp');
							break;

						}
						//set Moodle internal id
						// fix course record if needed and check for missing values or database collision
						if ($errmsg=ws_checkcourserecord($course,false)) {
							$rcourse->error=$errmsg;
							break;
						}

						$course->timemodified = time(); //not done in Moodle 1.9 update_course ?

                        //GROS PB avec le record rempli de 0 !!!!
                        foreach($course as $key=>$value) {
                            if (empty($value)) unset ($course->$key);
                        }
// in Moodle 2.0 update_course returns nothing !
						if (!ws_update_course($course)) {
							$rcourse->error=get_string('ws_errorupdatingcourse','local_wspp',$course->id);
						} else  {
							$rcourse = ws_get_record('course', 'id', $course->id); //return new value
                            break;
                        }
                        //TODO if the category has changed ....
                        if ($oldcourse->category != $course->category) {
                            //do the move via course/lib.php#move_courses (array($course->id),$course->category)
                            // caution this function may send somme notify errors ...
                        }


						break;
					case 'delete' :
						/// Deleting an existing course

						if (! $course = ws_get_record('course', 'id', $course->id)) {
							$rcourse->error = get_string('ws_courseunknown','local_wspp',"id=".$course->id );
							break;
						}
						$rcourse=$course;
                        //$this->debug_output("DC".print_r($course,true));
						/// Now check for correct permissions.
						if (!$this->has_capability("moodle/course:delete",CONTEXT_COURSECAT,$course->category)) {
							$rcourse->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}
						if (!delete_course($course->id,false)) {
							$rcourse->error=get_string('ws_errordeletingcourse','local_wspp',$course->id);
						}

						break;
                    default :
                        $rcourse->error=get_string('ws_invalidaction','local_wspp',$course->action);
				}
                $ret[] = $rcourse;
			}

		}
		return $ret;
	}


   /**
    * Edit grouping records (add/update/delete).
    * @uses $CFG
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param array $groupings An array of grouping records (objects or arrays) for editing
    *                     (including operation to perform).
    * @return array Return data (grouping record) to be converted into a
    *               specific data format for sending to the client.
    */
    function edit_groupings($client, $sesskey, $groupings) {
        global $CFG;
        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        
        if ($CFG->wspp_using_moodle20) {
        	// not anymore included by defualt in Moodle 2.0
        	require_once ($CFG->dirroot.'/group/lib.php');
        }
        
        $rets = array ();
        if (!empty ($groupings)) {
            foreach ($groupings->groupings as $grouping) {
                $ret = new stdClass;
                $ret->error="";
                switch (trim(strtolower($grouping->action))) {
                    case 'add' :
                        /// Adding a new group.
                        if (!empty($grouping->courseid)) {
                            if (! $course = ws_get_record('course', 'id', $grouping->courseid)) {
                            $ret->error = get_string('ws_courseunknown','local_wspp',"id=".$grouping->courseid );
                            break;
                            }
                            if (ws_get_record('groupings','name',$grouping->name,'courseid',$grouping->courseid)) {
                                $ret->error = get_string('ws_duplicategroupingname','local_wspp',$grouping->name );
                                break;
                            }
                            if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $grouping->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                            }
                        } else {
                        /// Check for correct permissions. at site level
                            if (!$this->has_capability('moodle/course:managegroups', CONTEXT_SYSTEM, 0)) {
                                $ret->error=get_string('ws_operationnotallowed','local_wspp');
                                break;
                            }
                        }
                        if ($id=groups_create_grouping($grouping)) {
                        $ret = ws_get_record('groupings', 'id', $id);
                        }else {
                            $ret->error=get_string('ws_errorcreatinggrouping','local_wspp',$grouping->name);
                        }

                        break;
                    case 'update' :
                        /// Updating an existing group
                                   $ret=$grouping;
                        if (! $oldgrouping = ws_get_record('groupings', 'id', $grouping->id)) {
                            $ret->error = get_string('ws_groupingunknown','local_wspp',"id=".$grouping->id );
                            break;
                        }

                        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $oldgrouping->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }
                        //TODO check for changing course

                        foreach ($grouping as $key => $value) {
                            if (empty ($value))
                                unset($grouping-> $key);
                        }

                        if (groups_update_grouping($grouping)) {
                        $ret = ws_get_record('groupings', 'id', $grouping->id);
                        }else {
                            $ret->error=get_string('ws_errorupdatinggrouping','local_wspp',$grouping->name);
                        }

                        break;
                    case 'delete' :
                        /// Deleting an existing grouping.
                        $ret=$grouping;
                          if (! $oldgrouping = ws_get_record('groupings', 'id', $grouping->id)) {
                            $ret->error = get_string('ws_groupingunknown','local_wspp',"id=".$grouping->id );
                            break;
                        }
                        $ret=$oldgrouping;

                        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $oldgrouping->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }
                        if (!groups_delete_grouping($grouping)) {
                            $ret->error==get_string('ws_errordeletinggrouping','local_wspp',$grouping->id);
                        }
                        break;
                    default :
                     $ret->error=get_string('ws_invalidaction','local_wspp',$group->action);

                        break;
                }
                $rets[] = $ret;
            }
        }
        return $rets;
    }






	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 START LILLE FUNCTIONS                                                     *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/

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
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        
        if ($CFG->wspp_using_moodle20) {
        	// not anymore included by defualt in Moodle 2.0
        	require_once ($CFG->dirroot.'/group/lib.php');
        }
        
        $rets = array ();
        if (!empty ($groups)) {
            foreach ($groups->groups as $group) {
                $ret = new stdClass;
                $ret->error="";
                switch (trim(strtolower($group->action))) {
                    case 'add' :
                        /// Adding a new group.
                        if (!empty($group->courseid)) {
                            if (! $course = ws_get_record('course', 'id', $group->courseid)) {
                            $ret->error = get_string('ws_courseunknown','local_wspp',"id=".$group->courseid );
                            break;
                            }
                            if (ws_get_record('groups','name',$group->name,'courseid',$group->courseid)) {
                                $ret->error = get_string('ws_duplicategroupname','local_wspp',$group->name );
                                break;
                            }
                            if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $group->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                            }
                        } else {
                        /// Check for correct permissions. at site level
                            if (!$this->has_capability('moodle/course:managegroups', CONTEXT_SYSTEM, 0)) {
                                $ret->error=get_string('ws_operationnotallowed','local_wspp');
                                break;
                            }
                        }
                        if ($id=groups_create_group($group,false)) {
                        $ret = ws_get_record('groups', 'id', $id);
                        }else {
                            $ret->error=get_string('ws_errorcreatinggroup','local_wspp',$group->name);
                        }

                        break;
                    case 'update' :
                        /// Updating an existing group
                         $ret=$group;
                        if (! $oldgroup = ws_get_record('groups', 'id', $group->id)) {
                            $ret->error = get_string('ws_groupunknown','local_wspp',"id=".$group->id );
                            break;
                        }

                        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $oldgroup->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }
                        //TODO check for changing course

                        foreach ($group as $key => $value) {
                            if (empty ($value))
                                unset($group-> $key);
                        }
                        if (groups_update_group($group,false)) {
                        $ret = ws_get_record('groups', 'id', $group->id);
                        }else {
                            $ret->error=get_string('ws_errorupdatinggroup','local_wspp',$group->name);
                        }

                        break;
                    case 'delete' :
                        /// Deleting an existing group.
                          $ret=$group;
                          if (! $oldgroup = ws_get_record('groups', 'id', $group->id)) {
                            $ret->error = get_string('ws_groupunknown','local_wspp',"id=".$group->id );
                            break;
                        }
                        $ret=$oldgroup;

                        if (!$this->has_capability('moodle/course:managegroups', CONTEXT_COURSE, $oldgroup->courseid)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }
                        if (!groups_delete_group($group)) {
                            $ret->error==get_string('ws_errordeletinggroup','local_wspp',$group->id);
                        }
                        break;
                    default :
                     $ret->error=get_string('ws_invalidaction','local_wspp',$group->action);

                        break;
                }
                $rets[] = $ret;
            }
        }
        return $rets;
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
		    return $this->error(get_string('ws_invalidclient', 'local_wspp'));
	    }
	    $rets = array ();
	    if (!empty ($categories)) {
		    foreach ($categories->categories as $category) {
			    $this->debug_output("ac".print_r($category,true));
			    $ret=new StdClass();
			    switch (trim(strtolower($category->action))) {
				    case 'add' :
					    /// Adding a new category.
					    $ret=$category; // returns proposed values
					    if (!empty($category->parent)) {
						    /// Check if category with id specified exists
						    if (!$parent = ws_get_record('course_categories', 'id', $category->parent)) {
							    $ret->error(get_string('ws_categoryunkown','local_wspp',"id=".$category->parent));
							    break;
						    }
						    if (!$this->has_capability('moodle/category:manage', CONTEXT_COURSECAT, $parent->id)) {
							    $ret->error=get_string('ws_operationnotallowed','local_wspp');
							    break;
						    }
					    } else {
						    /// Check for correct permissions.
						    if (!$this->has_capability('moodle/category:manage', CONTEXT_SYSTEM, 0)) {
							    $ret->error=get_string('ws_operationnotallowed','local_wspp');
							    break;
						    }
					    }

					    $category->sortorder = 999; // will be fixed later
                        //find the max of parent category and add 1
					    if (!$cid = ws_insert_record('course_categories', $category)) {
						    $ret->error =get_string('ws_errorcreatingcategory','local_wspp',$category->name);
						    break;
					    }
					    $context = get_context_instance(CONTEXT_COURSECAT, $cid);
					    mark_context_dirty($context->path);
					    fix_course_sortorder(); // Required to build course_categories.depth and .path.

					    $ret = ws_get_record('course_categories', 'id', $cid);

					    break;
				    case 'update' :
					    /// Updating an existing category.
					    $cid = $category->id;
					    if (!$oldcategory = ws_get_record('course_categories', 'id', $cid)) {
						    $ret->error =   $ret->error(get_string('ws_categoryunkown','local_wspp',"id=".$cid));
						    break;
					    }
					    if (!$this->has_capability("moodle/category:update", CONTEXT_COURSECAT, $cid)) {
						    $ret->error=get_string('ws_operationnotallowed','local_wspp');
						    break;
					    }
					    if ($oldcategory->parent != $category->parent) {
						    if (!$this->has_capability("moodle/category:create", CONTEXT_COURSECAT, $category->parent)) {
							    $ret->error=get_string('ws_operationnotallowed','local_wspp');
							    break;
						    }
						    if (!$this->has_capability("moodle/category:delete", CONTEXT_COURSECAT, $oldcategory->parent)) {
							    $ret->error=get_string('ws_operationnotallowed','local_wspp');
							    break;
						    }
					    }
					    /// Update values in the category database record with what
					    /// the client supplied.
					    /**
					     foreach ($category as $key => $value) {
					     if (!empty ($value)) // rev 1.5.15 must ignore empty values ! serious flaw !
					         unset($category-> $key);
					     }
					     **/
					    if ($oldcategory->parent != $category->parent) {
						    if (!move_category($cid, $category->parent)) {
							    $ret->error = get_string('ws_errorupdatingcategory','local_wspp',$cid);
							    break;
						    }
					    }

					    $category->timemodified = time();
					    if (! ws_update_record('course_categories', $category)) {
						    $ret->error = get_string('ws_errorupdatingcategory','local_wspp',$cid);
						    break;
					    }
					    $ret = ws_get_record('course_categories', 'id', $cid);

					    break;

				    case 'delete' :
					    /// Deleting an existing category.
                        $ret->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$category->action);
					    break;
				    default :
					    $ret->error=get_string('ws_invalidaction','local_wspp',$category->action);
				    break;
			    }
			    $rets[] = $ret;
		    }
	    }
	    return $rets;
    }





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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($labels)) {
			foreach ($labels->labels as $label) {
				switch (trim(strtolower($label->action))) {
					case 'add' :
						/// Adding a new label.
						$ret = $label;

                         if (!$course = ws_get_record("course", "id", $label->course)) {
                            $ret->error=get_string('ws_courseunknown','local_wspp',"id=".$label->course );
                            break;
                        }
						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $course->id)) {
                             $ret->error=get_string('ws_operationnotallowed','local_wspp');

							break;
						}
						//function label_add_instance has a bug in moodle
						/*
						in file mod\label\lib.php
						function label_add_instance calls get_label_name
						inside get_label_name variable name is collected from content field and not from name
                        provided here ...
						$name = addslashes(strip_tags(format_string(stripslashes($label->content),true)));
						*/
						if (!$labelid = label_add_instance($label)) {
							$ret->error = get_string('ws_errorcreatinglabel','local_wspp', $label->name);
							break;
						}
						$ret = ws_get_record('label', 'id', $labelid);

						break;
					case 'update' :
						$ret->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$label->action);
						break;
					case 'delete' :
						$ret->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$label->action);
						break;
					default :
						$ret->error =get_string('ws_invalidaction','local_wspp',$label->action);
				}
				$rets[] = $ret;
			}
		}
		return $rets;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets= array ();

		if (!empty ($sections)) {
			foreach ($sections->sections as $section) {

				switch (trim(strtolower($section->action))) {
					case 'add' :
						/// Adding a new section.
						$ret = $section;

						$this->debug_output('EDIT_SECTIONS:    Trying to add a new section.');

                          if (!$course = ws_get_record("course", "id", $section->course)) {
                            $ret->error=get_string('ws_courseunknown','local_wspp',"id=".$section->course );
                            break;
                        }

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $course->id)) {
							$ret->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}
						// verify if current section is already in database
						if ($sectionExist = ws_get_record("course_sections", "course", $section->course, "section", $section->section)) {
							$ret = $sectionExist;
							$ret->error=get_string('ws_sectionexists','local_wspp',$section->course);
							break;
						}
						if (!$resultInsertion = ws_insert_record("course_sections", $section)) {
							$ret->error =get_string('ws_errorcreatingsection','local_wspp',$section->summary);
							break;
						}
						$ret = ws_get_record('course_sections', 'id', $resultInsertion);

						break;
					case 'update' :
						//get the section record
						if (!($oldsection = ws_get_record('course_sections', 'id', $section->id))) {
							return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$section->id));
						}
						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $oldsection->course)) {
							$ret->error=get_string('ws_operationnotallowed','local_wspp');
							break;
						}

						unset($section->sequence); //don't mess with these
						if (empty($section->course))
                             unset($section->course);
                        if (empty($section->section)) //TODO move_sections ?
                            unset($section->section);
						if (! ws_update_record('course_sections', $section)) {
							$ret->error = get_string('ws_errorupdatingsection','local_wspp',$section->id);
							break;
						}
						$ret = ws_get_record('course_sections', 'id', $section->id);

                        if ($section->visible !=$oldsection->visible) {
                             set_section_visible($oldsection->course, $oldsection->section, $section->visible);
                        }

						break;
					case 'delete' :
						$ret->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$section->action);
						break;
					default :
						$ret->error = get_string('ws_invalidaction','local_wspp',$section->action);
				}
				$rets[] = $ret;
			}
		}
		return $rets;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($forums)) {
			foreach ($forums->forums as $forum) {
				switch (trim(strtolower($forum->action))) {
					case 'add' :
						/// Adding a new forum.
						$ret = $forum;
						if (empty ($forum->type)) {
							$forum->type = "general";
						}
						if (!array_key_exists($forum->type, forum_get_forum_types_all())) {
							$ret->error = get_string('ws_illegaleforumtype','local_wspp',$forum->type);
							break;
						}
						//TODO in debugging mode do the operation but send and error in libgrade
						// since courseid is null
                          //for some reason lib/gradelib.php test is_null(courseid) and not empty () !!!
                         // course MUST exist since this activity is graded !
                          if (! $course = ws_get_record('course', 'id', $forum->course)) {
                            $ret->error = get_string('ws_courseunknown','local_wspp',"id=".$forum->course );
                            break;
                          }

                        /// Check for correct permissions.
                        if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $course->id)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }

						if (!$resultInsertion = forum_add_instance($forum)) {
							$ret->error =get_string('ws_errorcreatingforum','local_wspp', $forum->name);
							break;
						}
						$ret = ws_get_record('forum', 'id', $resultInsertion);
						break;
					case 'update' :
						$ret->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$forum->action);
						break;
					case 'delete' :
						$ret->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$forum->action);
						break;
					default :
						$ret->error = get_string('ws_invalidaction','local_wspp',$forum->action);
				}
				$rets[] = $ret;
			}
		}
		return $rets;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($assignments)) {
			foreach ($assignments->assignments as $assignment) {
				switch (trim(strtolower($assignment->action))) {
					case 'add' :
						//creation of the new assignment
                        $ret=$assignment;


						// verification of the field  "assignmenttype"
                        $assignmenttypes = get_list_of_plugins('mod/assignment/type');
						if (!in_array($assignment->assignmenttype,$assignmenttypes)) {
                        	$ret->error = get_string('ws_assignmenttypeunknown','local_wspp',$assignment->assignmenttype);
							break;
						}

                        //TODO in debugging mode do the operation but send and error in libgrade
                        // since courseid may be empty
                        //for some reason lib/gradelib.php test is_null(courseid) and not empty () !!!
                       // if (empty($assignment->course)) $assignment->course=NULL;
                       // course MUST exist since this activity is graded !
						  if (! $course = ws_get_record('course', 'id', $assignment->course)) {
                            $ret->error = get_string('ws_courseunknown','local_wspp',"id=".$assignment->course );
                            break;
                          }
                        /// Check for correct permissions.
                        if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $course->id)) {
                            $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }

                        if (!($assignId = assignment_add_instance($assignment))) {
							$ret->error = get_string('ws_errorcreatingassignment','local_wspp', $assignment->name);
							break;
						}
						$ret = ws_get_record("assignment",'id',$assignId);

						break;
					case 'update' :
						$ret->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$assignment->action);
						break;
					case 'delete' :
						//delete assignment
                        $ret->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$assignment->action);

						break;
					default :
						$ret->error = get_string('ws_invalidaction','local_wspp',$assignment->action);
						break;
				}
				$rets[] = $ret;
			}
		}
		return $rets;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($databases)) {
			foreach ($databases->databases as $database) {
				switch (trim(strtolower($database->action))) {
					case 'add' :
						//add a new database
						$ret = $database;


						if (empty ($database->name)) {
							$ret->error =get_string('ws_missingvalue','local_wspp','name');
							break;
						}
                         // course MUST exist since this activity is graded !
                          if (! $course = ws_get_record('course', 'id', $database->course)) {
                            $ret->error = get_string('ws_courseunknown','local_wspp',"id=".$database->course );
                            break;
                          }

                        if (!$this->has_capability('moodle/category:manageactivities', CONTEXT_COURSE, $course->id)) {
                             $ret->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
                        }

						// database creation
						if (!$dbid = data_add_instance($database)) {
                            $ret->error=get_string('ws_errorcreatingdatabase','local_wspp', $ret->name);
							break;
						}
						$ret = ws_get_record('data','id',$dbid);

						break;
					case 'update' :
						//not implemented
						$ret->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$database->action);
						break;
					case 'delete' :
						//not implemented
						$ret->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$database->action);
						break;
					default :
						$ret->error = $ret->error = get_string('ws_invalidaction','local_wspp',$database->action);
						break;
				}
				$rets[] = $ret;
			}
		}
		return $rets;
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
		global $CFG,$USER;
		require_once ($CFG->dirroot . '/mod/wiki/lib.php');
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($wikis)) {
			foreach ($wikis->wikis as $wiki) {
				switch (trim(strtolower($wiki->action))) {
					case 'add' :
						$this->debug_output('EDIT_WIKIS:     Trying to add a new wiki.');
						/// Adding a new wiki
						$rwiki = $wiki;

                         // course MUST exist since this activity is graded !
                          if (! $course = ws_get_record('course', 'id', $wiki->course)) {
                            $rwiki->error = get_string('ws_courseunknown','local_wspp',"id=".$assignment->course );
                            break;
                          }

                        /// Check for correct permissions.
                        if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $course->id)) {
                             $rwiki->error=get_string('ws_operationnotallowed','local_wspp');

                            break;
                        }

						//verify if current wiki is already in database
						if ($wikiExist = ws_get_record("wiki", "name", $wiki->name, "course", $wiki->course)) {
							$rwiki = $wikiExist;
							break;
						}
						$rwiki->pagename = empty ($rwiki->pagename) ? $rwiki->name : $rwiki->pagename;
						$rwiki->wtype = empty ($rwiki->wtype) ? 'group' : $rwiki->wtype;
                        $allowedtypes=array('group','teacher','student');
						if (! in_array($rwiki->wtype,$allowedtypes)) {
							$rwiki->error = get_string('ws_wikiincorrecttype','local_wspp',$rwiki->wtype);
							break;
						}
						//add instance of wiki
						if (!($wikiId = wiki_add_instance($rwiki))) {
							$rwiki->error=get_string('ws_errorcreatingwiki','local_wspp', $rwiki->pagename);
							break;
						}
						$rwiki->id = $wikiId;
                        $wiki_entry=new StdClass();
						$wiki_entry->wikiid = $wikiadd->id;
						$wiki_entry->course = 0;
						$wiki_entry->groupid = 0;
						$wiki_entry->userid = $USER->id;
						$wiki_entry->pagename = $rwiki->pagename;
						if (!$result = ws_insert_record("wiki_entries", $wiki_entry)) {
							$rwiki->error = get_string('ws_errorcreatingwikientry','local_wspp', $rwiki->pagename);
							break;
						}
						$rwiki = ws_get_record('wiki', 'id', $wikiId);

						break;
					case 'update' :
						$rwiki->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$wiki->action);
						break;
					case 'delete' :
                        $rwiki->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$wiki->action);
						break;
					default :
                        $rwiki=new StdClass();
						$rwiki->error = $ret->error = get_string('ws_invalidaction','local_wspp',$wiki->action);
				}
				$rets[] = $rwiki;
			}
		}
		return $rets;
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
		global $CFG,$USER;
		require_once ($CFG->dirroot . '/mod/wiki/lib.php');
		if (!$this->validate_client($client, $sesskey,__FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$rets = array ();
		if (!empty ($pagesWiki)) {
			foreach ($pagesWiki->pagesWiki as $page) {

				switch (trim(strtolower($page->action))) {
					case 'add' :

						$this->debug_output('EDIT_PAGESWIKI:     Trying to add a new pageWiki.');
						$pageadd = $page;
						$pageadd->userid = $USER->id;
						$pageadd->created = time();
						$pageadd->lastmodified = time();

						/// Check for correct permissions.
						if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_SYSTEM, 0)) {
							 $rpage->error=get_string('ws_operationnotallowed','local_wspp');
                            break;
						}
						//verify if current page is already in database
						if ($pg = ws_get_record("wiki_pages", "pagename", $pageadd->pagename, "wiki", $pageadd->wiki)) {
							$rpage = $pg;
							break;
						}
						if (!$resultInsertion = ws_insert_record("wiki_pages", $pageadd)) {
							$rpage->error = "EDIT_PAGESWIKI:     Error at insertion of the page.";
							break;
						}
						$rpage = ws_get_record('wiki_pages', 'id', $resultInsertion);

						break;
					case 'update' :
						$rpage->error = get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$page->action);
						break;
					case 'delete' :
						$rpage->error =  get_string('ws_notimplemented','local_wspp',__FUNCTION__." ".$page->action);
						break;
					default :
						$rpage->error = get_string('ws_invalidaction','local_wspp',$page->action);
				}
			}
			$rets[] = $rpage;
		}
		return $rets;
	}



    /*
    * Comments:
    * All the affect methods are returning a generic object type named affectRecord
    * This object has two fields: status and error
    *       status indicates if operation succeded
    *       if status=false then the error field contains the coresponding error message
    */



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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}

		//get the section record
		if (!($section = ws_get_record('course_sections', 'id', $sectionid))) {
			return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$sectionid));
		}
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}
		//get the label record
		if (!($label = ws_get_record('label', 'id', $labelid))) {
			return $this->error(get_string('ws_labelunknown','local_wspp','id='.$labelid));
		}
		//make compatible with the return type
		$r = new stdClass();
		$r->error="";
		if ($errmsg=ws_add_mod_to_section($labelid,'label',$section)) {
			$r->error=$errmsg;
		}else {
			$label->course = $section->course;
			if (!ws_update_record("label", $label)) {
                     $a=new StdClass();
                $a->id=$labelid;
                $a->course=$section->course;
                $r->error=get_string('ws_errorupdatingmodule','local_wspp',$a);
			}
		}
		$r->status =empty($r->error);
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
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
		  return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}

		//get the section record
        if (!($section = ws_get_record('course_sections', 'id', $sectionid))) {
                return $this->error(get_string('ws_sectionunknown','id='.$sectionid));
        }
		/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));

		}
		// check "groupmode" field
		if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
			return $this->error(get_string('ws_invalidgroupmode','local_wspp', $groupmode));
		}

		//get the forum record
		if (!($forum = ws_get_record('forum', 'id', $forumid))) {
			return $this->error(get_string('ws_forumunknown','local_wspp','id='.$forumid));
		}

//make compatible with the return type
        $r = new stdClass();
        $r->error="";
        if ($errmsg=ws_add_mod_to_section($forumid,'forum',$section,$groupmode)) {
            $r->error=$errmsg;
        }else {
            $forum->course = $section->course;
            if (!ws_update_record("forum", $forum)) {
                $a=new StdClass();
                $a->id=$forumid;
                $a->course=$section->course;
                $r->error=get_string('ws_errorupdatingmodule','local_wspp',$a);
            }
        }
        $r->status =empty($r->error);
        return $r;
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
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        //get the section record
        if (!($section = ws_get_record('course_sections', 'id', $sectionid))) {
                return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$sectionid));
        }
        /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }
        //get record of database
        if (!$database = ws_get_record("data", "id", $databaseid)) {
            return $this->error(get_string('ws_databaseunknown','local_wspp','id='.$databaseid));
            }

        //make compatible with the return type
        $r = new stdClass();
        $r->error="";
        if ($errmsg=ws_add_mod_to_section($databaseid,'data',$section)) {
            $r->error=$errmsg;
        }else {
            $database->course = $section->course;
            if (!ws_update_record("data", $database)) {
                     $a=new StdClass();
                $a->id=$databaseid;
                $a->course=$section->course;
                $r->error=get_string('ws_errorupdatingmodule','local_wspp',$a);
                 }
        }
        $r->status =empty($r->error);
        return $r;

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
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }

        //get the section record
        if (!($section = ws_get_record('course_sections', 'id', $sectionid))) {
                return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$sectionid));
        }
        /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }
        if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
           return $this->error(get_string('ws_invalidgroupmode','local_wspp', $groupmode));
        }
        //get the assignment record
        if (!$assign = ws_get_record("assignment", "id", $assignmentid)) {
            return $this->error(get_string('ws_assignmentunknown','local_wspp','id='.$assignmentid));
        }

       //make compatible with the return type
        $r = new stdClass();
        $r->error="";
        if ($errmsg=ws_add_mod_to_section($assignmentid,'assignment',$section,$groupmode)) {
            $r->error=$errmsg;
        }else {
            $assign->course = $section->course;
            if (!ws_update_record("assignment", $assign)) {
                     $a=new StdClass();
                $a->id=$assignmentid;
                $a->course=$section->course;
                $r->error=get_string('ws_errorupdatingmodule','local_wspp',$a);
                 }
        }
        $r->status =empty($r->error);
        return $r;
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
		    return $this->error(get_string('ws_invalidclient', 'local_wspp'));
	    }
	    //get the section record
	    if (!($section = ws_get_record('course_sections', 'id', $sectionid))) {
		    return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$sectionid));
	    }
	    /// Check for correct permissions.
	    if (!$this->has_capability($client, $sesskey, 'moodle/course:manageactivities', CONTEXT_COURSE, $section->course)) {
		    return $this->error(get_string('ws_operationnotallowed','local_wspp'));
	    }
	    //check if exists in db this id & get wiki record
	    if (!$wiki = ws_get_record("wiki", "id", $wikiid)) {
		    return $this->error(get_string('ws_wikiunknown','local_wspp','id='.$wikiid));
	    }
	    // check "groupmode" field
	    if (($groupmode != NOGROUPS) && ($groupmode != SEPARATEGROUPS) && ($groupmode != VISIBLEGROUPS)) {
		    return $this->error(get_string('ws_invalidgroupmode','local_wspp', $groupmode));
	    }

	    if (($groupmode == SEPARATEGROUPS) || ($groupmode == VISIBLEGROUPS)) {
		    if ($group = ws_get_record("groups", "courseid", $section->course)) {

			    $wiki2->groupid = $group->id;
		    } else {
			    $groupmode = 0;
		    }
	    }

	    if (!$wiki_entry = ws_get_record("wiki_entries", "wikiid", $wikiid)) {
		    return $this->error("AFFECT_WIKI_TO_SECTION:  Wiki with ID $wikiid does not have an entry");
	    }


	    //make compatible with the return type
	    $r = new stdClass();
	    $r->error="";
	    if ($errmsg=ws_add_mod_to_section($wikiid,'wiki',$section,$groupmode,$visible)) {
		    $r->error=$errmsg;
	    }else {
		    $wiki->course = $section->course;
		    if (!ws_update_record("wiki", $wiki)) {
                     $a=new StdClass();
                $a->id=$wikiid;
                $a->course=$section->course;
                $r->error=get_string('ws_errorupdatingmodule','local_wspp',$a);

		    }
            $wiki2=new StdClass();
		    $wiki2->id = $wiki_entry->id;
		    $wiki2->wikiid = $wikiid;
		    $wiki2->course = $section->course;
		    //update "wiki_entries"
		    if (!ws_update_record("wiki_entries", $wiki2)) {
			    return $this->error("AFFECT_WIKI_TO_SECTION:     Impossible to acces WIKI_ENTRIES table");
		    }
	    }
	    $r->status =empty($r->error);
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
	function affect_section_to_course($client, $sesskey, $sectionid, $courseid,$idfield='id') {
		global $CFG;
		require_once ($CFG->dirroot . '/course/lib.php');
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}

        if (!$course = ws_get_record("course", $idfield, $courseid)) {
              return $this->error(get_string('ws_courseunknown','local_wspp',$idfield."=".$courseid ));

        }

	/// Check for correct permissions.
		if (!$this->has_capability('moodle/course:update', CONTEXT_COURSE, $course->id)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}
		//get section
        if (!($cur_section = ws_get_record('course_sections', 'id', $sectionid))) {
                return $this->error(get_string('ws_sectionunknown','local_wspp','id='.$sectionid));
        }


		if ($cur_section->section > $cur_course->numsections) {
			return $this->error("AFFECT_SECTION_TO_COURSE:     Section index $cur_section->section too big. Maximum section number: $cur_course->numsections.");
		}
		//verify if current course has already assigned this section
		if ($duplicate = ws_get_record("course_sections", "course", $courseid, "section", $cur_section->section)) {
			if ($sectionid != $duplicate->id) {
				if (!empty ($duplicate->sequence)) {
					$modarray = explode(",", $duplicate->sequence);
					if (!empty ($cur_section->sequence))
						$modarray2 = explode(",", $cur_section->sequence);
					else
						$modarray2 = array ();
					foreach ($modarray as $key) {
						$module = ws_get_record("course_modules", "id", $key);
						$module->section = $sectionid;
						ws_update_record("course_modules", $module);
						array_push($modarray2, $key);
					}
					$cur_section->sequence = implode(",", $modarray2);
				}
				delete_records("course_sections", "id", $duplicate->id);
			}
		}
		$cur_section->course = $courseid;
		if (!ws_update_record("course_sections", $cur_section)) {
            $a=new StdClass();
            $a->id=$cur_section->id;
                $a->course=$courseid;
                $r->error=get_string('ws_errorupdatingsection','local_wspp',$a);
		}

		$r = new stdClass();
		$r->status = true;
		return $r;
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
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}

		//we verify if we have the permission to do this operation
		if (!$cm = get_coursemodule_from_instance('wiki', $wikiid)) {
			return $this->error("Course Module ID was not found. We can't verify if you have permission to do this operation");
		}
		if (!$this->has_capability('mod/wiki:participate', CONTEXT_MODULE, $cm->id)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}
		//verify if the wiki exist in the database
		if (!($wiki = ws_get_record("wiki", "id", $wikiid))) {
            return $this->error(get_string('ws_wikiunknown','local_wspp','id='.$wikiid));

		}
		//we verify if the wiki exist in wiki_entries
		if (!($wiki_entry = ws_get_record("wiki_entries", "wikiid", $wiki->id))) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     The wiki does not exist in wiki_entries");
		}
		//verify if the page of wiki exist in DB
		if (!($page = ws_get_record("wiki_pages", "id", $pageid))) {
            return $this->error(get_string('ws_wikipageunknown','local_wspp','id='.$pageid));
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
			if (!($result = ws_insert_record("wiki_pages", $first_page, true))) {
				return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at insertion of the first page of wiki.";
			}
			$first_page = ws_get_record("wiki_pages", "id", $result);
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
			if (!ws_update_record("wiki_pages", $page)) {
				return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at update page of wiki.";
			}
			$res->status = true;
			return $res;
		}
		//verify if in database exist another page with the same name assigned to this wiki
		if ($page2 = ws_get_record("wiki_pages", "pagename", $page->pagename, "wiki", $wiki_entry->id)) {
			return $this->error("AFFECT_PAGEWIKI_TO_WIKI:     A page of wiki with this name (id=$page2->id)is already assigned to the wiki with ID:$wiki->id");
		}
		$page->wiki = $wiki_entry->id;
		$page->version = 1;
		$page->flags = 1;
		//  update of the page of wiki
		if (!ws_update_record("wiki_pages", $page)) {
			return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Error at update page of wiki.";
		}
		//create link for the page affected
		$first_page->content = $first_page->content . "<br>[" . $page->pagename . "]";
		if (!ws_update_record("wiki_pages", $first_page)) {
			return $this->error = "AFFECT_PAGEWIKI_TO_WIKI:      Can not create link to the page new created.";
		}

		$res->status = true;
		return $res;
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
          return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }


        /// Check if category with id specified exists
        if (!$destcategory = ws_get_record('course_categories', 'id', $categoryid)) {
            return $this->error(get_string('ws_categoryunkown','local_wspp',"id=".$categoryid));
        }
        /// Check if course with id specified exists
        if (!$course = ws_get_record('course', 'id', $courseid)) {
            return $this->error(get_string('ws_courseunknown','local_wspp',"id=".$courseid));
        }

         /// Check for correct permissions.
        if (!$this->has_capability('moodle/course:create', CONTEXT_COURSECAT, $categoryid)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
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
		$rolename = empty ($rolename) ? "student" : $rolename;
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
	function remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename) {

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
		  return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($res = ws_get_records('wiki', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = filter_wikis($client, $res);
		}
		return $ret;
	}
	function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, 'get_all_pagesWiki')) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($res = ws_get_records('wiki_pages', $fieldname, $fieldvalue, 'pagename', '*')) {
			$ret = filter_pagesWiki($client, $res);
		}
		return $ret;
	}
	function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($res = ws_get_records('groups', $fieldname, $fieldvalue, 'name', '*')) {
			$ret = filter_groups($client, $res);
		}
		return $ret;
	}
	function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($forums = ws_get_records("forum", $fieldname, $fieldvalue, "name")) {
			$ret = filter_forums($client, $forums);
		}
		return $ret;
	}
	function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
	         return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($labels = ws_get_records("label", $fieldname, $fieldvalue, "name")) {
			$ret = filter_labels($client, $labels);
		}
		return $ret;
	}
	function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($assignments = ws_get_records("assignment", $fieldname, $fieldvalue, "name")) {
			$ret = filter_assignments($client, $assignments);
		}
		return $ret;
	}
	function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($databases = ws_get_records("data", $fieldname, $fieldvalue, "name")) {
			$ret = filter_databases($client, $databases);
		}
		return $ret;
	}

	function get_all_quizzes($client, $sesskey, $fieldname, $fieldvalue) {
		if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
			return $this->error(get_string('ws_invalidclient', 'local_wspp'));
		}
		$ret = array ();
		if ($quizzes = ws_get_records("quiz", $fieldname, $fieldvalue, "name")) {
			$ret = filter_resources($client, $quizzes);
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

  function get_all_groupings($client, $sesskey, $fieldname, $fieldvalue) {
        if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        $ret = array ();
        if ($res = ws_get_records('groupings', $fieldname, $fieldvalue, 'name', '*')) {
            $ret = filter_groupings($client, $res);
        }
        return $ret;
    }


     // rev 1.6.4
    function set_user_profile_values ($client,$sesskey,$userid,$useridfield,$values) {

    	global $CFG;
    	require_once($CFG->dirroot.'/user/profile/lib.php');

    	 if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
            return $this->error(get_string('ws_invalidclient', 'local_wspp'));
        }
        if (!$this->has_capability('moodle/user:update', CONTEXT_SYSTEM, 0)) {
            return $this->error(get_string('ws_operationnotallowed','local_wspp'));
        }

        if (!$user = ws_get_record('user', $useridfield, $userid)) {
			return $this->error =get_string('ws_userunknown','local_wspp',$useridfield."=".$userid);
        }

        $ret=array();


        foreach($values as $value) {
	        if (!isset($value->name) && !isset($value->value))
		        continue;

	        if (!$field = ws_get_record('user_info_field', 'shortname', $value->name)) 

		        return  $this->error(get_string('ws_profileunknown','local_wspp','shortname='.$value->name));
	        $fvalue=$value->value;

	        switch ($field->datatype) {
	        	case 'menu':
	        	    //convert the passed string to an indice in array of possible values
	        		$fvalue=array_search($fvalue,explode("\n", $field->param1));
	        		if ( FALSE===$fvalue)
	        			return $this->error(get_string('ws_profileinvalidvaluemenu','local_wspp',$value->value));
	        		break;
	        	case 'checkbox':
	        		if ((int)$fvalue != 0 && (int)$fvalue != 1)
	        			return $this->error(get_string('ws_profileinvalidvaluecheckbox','local_wspp'));
	        		break;
	        	case 'text':
	        		$fvalue = substr($fvalue, 0, $field->param2);
	        		break;
	        }

	        require_once($CFG->dirroot.'/user/profile/field/'.$field->datatype.'/field.class.php');
	        $newfield = 'profile_field_'.$field->datatype;
	        $formfield = new $newfield($field->id, $user->id);


	        $user->{$formfield->inputname}=$fvalue;
	        //$this->debug_output(print_r($formfield,true));
	        $formfield->edit_save_data($user);
	        $ret[]=$value;
        }

        return $ret;

    }



    function get_users_byprofile($client,$sesskey,$profilefieldname,$profilefieldvalue) {
	    global $CFG;
	    if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
		    return $this->error(get_string('ws_invalidclient', 'local_wspp'));
	    }
	    if (!$this->has_capability('moodle/site:viewparticipants',CONTEXT_SYSTEM, 0)) {
		    return $this->error(get_string('ws_operationnotallowed','local_wspp'));
	    }
	    //make sure required custom field exists
	    if (!($field = ws_get_record("user_info_field", "shortname", $profilefieldname))) {
		    return $this->error(get_string('ws_profileunknown','local_wspp','shortname='.$profilefieldname));
	    }

	    $profilefieldvalue=addslashes($profilefieldvalue);

	    $where = "where fieldid={$field->id} and data='$profilefieldvalue'" ;
	    $where="id in (SELECT userid FROM {$CFG->prefix}user_info_data $where)";
	    // return $this->error($where);
	    
    	 $ret=ws_get_records_select('user',$where);	    

	    //also add custom profile values
	    return filter_users($client, $ret, 0);
    }


    /**
   * rev 1.6.5 added upon request on tstc.edu
   */
   function get_quiz ($client,$sesskey,$quizid,$format='xml') {
   	if (!$this->validate_client($client, $sesskey, __FUNCTION__)) {
		    return $this->error(get_string('ws_invalidclient', 'local_wspp'));
	    }

	    //get the quiz record
		if (!$quiz = ws_get_record("quiz", "id", $quizid)) {
			return $this->error(get_string('ws_quizunknown','local_wspp','id='.$quizid));
		}
		/// Check for correct permissions.
		if (!$this->has_capability('mod/quiz:manage', CONTEXT_COURSE, $quiz->course)) {
			return $this->error(get_string('ws_operationnotallowed','local_wspp'));
		}

		require_once("libquiz.php");

		if (! ws_libquiz_is_supported_format ($format))
		return $this->error(get_string('ws_quizexportunknownformat','local_wspp','format='.$format));

		$quiz->data=ws_libquiz_export($quiz,$format);
		return filter_quiz($client,$quiz);

   }

}
?>
