<?php


// $Id$

/**
 * utilities functions
 *
 * @package Web Services
 * @version $Id$
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.6
 */

/**
 * functions needed for this WS  to run under Moodle 1.9 and Moodle 2.0
 */

$CFG->wspp_using_moodle20 = file_exists($CFG->libdir . '/dml/moodle_database.php');


/**
 *  log all DB errors specific to new Moodle 2.0 API
 */

 function ws_error_log ($ex) {
	global $CFG;
	if (is_object($ex)){
		$info=$ex->getMessage() . '\n' . $ex->getTraceAsString();
	}else $info=$ex;
	error_log ($info,3,$CFG->dataroot.'/wspp_db_errors.log' );
}


/**
 * rev 1.8.4
 * in some instances, student role id may not be 5 ?
 * see http://moodle.org/mod/forum/post.php?reply=760858
 */
function ws_get_student_roleid () {
	$role=ws_get_record('role','shortname','student');
	return $role->id;
}


function ws_get_record($table, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '', $fields = '*') {

	global $CFG, $DB;

    if (empty($field1) || empty($value1)) return false; // rev 1.8.3 avoid unexpected results if some parameters are empty

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			//if ($field1)
				$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->get_record($table, $params, $fields);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_record($table, $field1, $value1, $field2, $value2, $field3, $value3, $fields);
}

function ws_get_records($table, $field = '', $value = '', $sort = '', $fields = '*', $limitfrom = '', $limitnum = '') {

	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			if ($field)
				$params[$field] = $value;
			return $DB->get_records($table, $params, $sort, $fields, $limitfrom, $limitnum);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_records($table, $field, $value, $sort, $fields, $limitfrom, $limitnum);
}

function ws_get_record_select($table, $select, $fields = '*') {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->get_record_select($table, $select, array (), $fields);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_record_select($table, $select, $fields);
}

function ws_get_records_select($table, $select, array $params = null, $sort = '', $fields = '*', $limitfrom = 0, $limitnum = 0) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
		return $DB->get_records_select($table, $select, null, $sort, $fields, $limitfrom, $limitnum);
		 } catch (Exception $e) {
		 	ws_error_log($e);
			 return false;
		 }
	}else
		return get_records_select($table, $select, $sort, $fields, $limitfrom, $limitnum);
}

function ws_get_record_sql ($sql) {
	global $CFG,$DB;
	if ($CFG->wspp_using_moodle20)
		return $DB->get_record_sql($sql);
	else
		return get_record_sql($sql);
}


function ws_get_records_sql ($sql, $limitfrom='', $limitnum='') {
	global $CFG,$DB;
	if ($CFG->wspp_using_moodle20)
		return $DB->get_records_sql($sql,null,$limitfrom, $limitnum);
	else
		return get_records_sql($sql, $limitfrom, $limitnum);
}

function ws_get_field($table, $return, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
		$params = array ();
		$params[$field1] = $value1;
		if ($field2)
			$params[$field2] = $value2;
		if ($field3)
			$params[$field3] = $value3;
		return $DB->get_field($table, $params);
		 } catch (Exception $e) {
		 	ws_error_log($e);
			 return false;
		 }
	} else
		return get_field($table, $field1, $value1, $field2, $value2, $field3, $value3);
}

function ws_set_field($table, $newfield, $newvalue, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->set_field($table, $newfield, $newvalue, $params);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return set_field($table, $newfield, $newvalue, $field1, $value1, $field2, $value2, $field3, $value3);

}

function ws_record_exists($table, $field1 = '', $value1 = '', $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->record_exists($table, $params);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}

	} else
		return record_exists($table, $field1, $value1, $field2, $value2, $field3, $value3);

}

function ws_insert_record($table, $record) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->insert_record($table, $record);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}

	} else
		return insert_record($table, $record);

}

function ws_update_record($table, $record) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->update_record($table, $record);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return update_record($table, $record);

}
/**
 * added revision 1.7 since Moodle 2.0 do not return anymore true/false
 */
function ws_update_course($course) {
	global $CFG;
	if ($CFG->wspp_using_moodle20) {
		try {
			update_course($course);
			return true;
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return update_course($course);
}

/**
 * added revision 1.7 since get_my_courses has been deprecated in Moodle 2.0
 */
function ws_get_my_courses($uid, $sort='',$extrafields=array()) {
	global $CFG,$DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			 $context = context_system::instance();

    		if (has_capability('moodle/course:create' , $context, $uid,true)) {
				//ws_error_log ("ok admin\n");
				return $DB->get_records('course',array(),$sort);
    		}
			// does not return annymore all courses for a site admin ...
			$ret=enrol_get_users_courses($uid, $onlyactive = false, $extrafields, $sort);
			return $ret;
		} catch (Exception $e) {
			ws_error_log($e);
			return array();
		}
	} else
		return get_my_courses($uid,$sort,$extrafields);
}

/**
 * added rev 1.7 since role_assign has changed order of parameters in Moodle 2.0
 * furthermore in Moodle 2.0 we MUST also enrol the user to the course if needed
 */
function ws_role_assign($roleid, $userid, $context, $timestart, $timeend,$course){
	global $CFG,$DB;
	ws_error_log("rid=$roleid uid=$userid cid=$context->id\n");
	if ($CFG->wspp_using_moodle20 && $context->contextlevel != CONTEXT_COURSECAT) {
		//moodle 2.0 no more groupid, timestart, timeend, hidden ...
		//return role_assign($roleid, $userid, $contextid);
		try{
			if (!$enrol_manual = enrol_get_plugin('manual'))
				throw new coding_exception('Can not instantiate enrol_manual');
			$instance = $DB->get_record('enrol',
				array('courseid' => $course->id, 'enrol' => 'manual'));
			if (empty($instance)) {
				// Only add an enrol instance to the course if non-existent
				$enrolid = $enrol_manual->add_instance($course);
				$instance = $DB->get_record('enrol', array('id' => $enrolid));
			}
			$enrol_manual->enrol_user($instance, $userid, $roleid, $timestart, $timeend);
			return true;
		} catch(Exception $e) {
			return false;
		}


	} else {
		return role_assign($roleid, $userid, $context->id);
	}
}

 /**
 * added rev 1.7 since role_assign has changed order of parameters in Moodle 2.0
 *  furthermore in Moodle 2.0 we MUST also unenrol the user to the course
 */
 function ws_role_unassign($roleid, $userid, $context,$course) {
 	global $CFG,$DB;
	if ($CFG->wspp_using_moodle20 && $context->contextlevel != CONTEXT_COURSECAT) {
		//moodle 2.0 no more groupid, timestart, timeend, hidden ...
		//return role_unassign($roleid, $userid, $contextid);
		try{
			if (!$enrol_manual = enrol_get_plugin('manual'))
				throw new coding_exception('Can not instantiate enrol_manual');
			$instance = $DB->get_record('enrol',
				array('courseid' => $course->id, 'enrol' => 'manual'));
			/**  in that case the instance MUST exist
			if (empty($instance)) {
				// Only add an enrol instance to the course if non-existent
				$enrolid = $enrol_manual->add_instance($course);
				$instance = $DB->get_record('enrol', array('id' => $enrolid));
			}
			**/
			$enrol_manual->unenrol_user($instance, $userid);
			return true;
		} catch(Exception $e) {
			return false;
		}


	} else {
		return role_unassign($roleid, $userid, $context->id);
	}

 }

/*
 *return primary role of userid in course
 *@param course $course an existing course record
 *@param int $userid :id of an existing user
 *
 */
function ws_get_primaryrole_incourse($course, $userid) {
	global $CFG;
	$context = context_course::instance($course->id);
	$context_cat = context_coursecat::instance($course->category);
	if ($context_cat && has_capability('moodle/category:manage', $context_cat, $userid))
		return 1;
	if ($context_cat && has_capability('moodle/course:create', $context_cat, $userid))
		return 2;
	if (has_capability('moodle/course:update', $context, $userid))
		return 3;
	if (has_capability('moodle/course:viewhiddenactivities', $context, $userid))
		return 4;
	//student
	// strange : guest may has also the course:view capability ?
	// so we treat it before regular student
	//guest CRASH in Moodle 2.0  this capability does not exist anymore
	//if (has_capability('moodle/legacy:guest', $context, $userid, false))
	//	return 6;
	// big change is Moodle 2.0
	// see http://docs.moodle.org/en/Development:Enrolment_usage_overview
	if (ws_is_enrolled($course->id,$userid))
			return 5;
	// return 0 in Moodle 2.0 if a student ????
	return 0;
}

/**
 * due to big changes in enrolment see http://docs.moodle.org/en/Development:Enrolment_usage_overview
 * the capability moodle/course:view is not anymore the good test to see if an user is enroled in a course !
 */
function ws_is_enrolled ($courseid,$userid) {
	global $CFG;
	$context = context_course::instance($courseid);
	if (!$CFG->wspp_using_moodle20) {
		return has_capability('moodle/course:view', $context, $userid, false);
	} else {
		return is_enrolled($context,$userid);

	}
}

/**
 * add admin default values to empty fields of a course
 */
function ws_fixcourserecord(& $course) {

	// ajout defaut de la conf globale
	$courseconfig = get_config('moodlecourse');
	foreach ($courseconfig as $key => $value) {
		if (empty ($course-> $key))
			$course-> $key = $value;
	}
	if (!isset ($course->startdate)) {
		$course->startdate = time();
	}
	$course->timecreated = time();
	$course->timemodified = time();
	//make sure a category is specified - default moodle category is implicit
	if (!isset ($course->category) || $course->category == 0) {
		$course->category = 1;

	}
}
/**
 * add some default values if not set by caller to a new user record
 */
function ws_fixuserrecord(& $user) {
	global $CFG;
	// prep a few params
	$user->modified = time();
	//Moodle 1.8 and later (a required field that must be non 0 for login )
	if (!empty ($CFG->mnet_localhost_id))
		if (empty ($user->mnethostid)) //if not set by caller
			$user->mnethostid = $CFG->mnet_localhost_id; // always local user
	if (empty ($user->confirmed)) {
		$user->confirmed = true;
	}

	if (empty ($user->auth))
		$user->auth = 'manual';
	if (empty ($user->lang)) {
		$user->lang = $CFG->lang;
	}
	$user->deleted = 0; // do not mess with this flag !
	if (!$CFG->wspp_using_moodle20)
		$user = addslashes_recursive($user);
}

/**
 *
 */

function ws_checkuserrecord(& $user, $newuser) {
	global $CFG;
	$errmsg = "";
	unset ($user->action); // remove it
	if (empty ($user->auth))
		$user->auth = 'manual';
	//rev 1.6.1 possible sync with external systems where pwd are also in md5
	if (!empty ($user->passwordmd5)) {
		$user->password = $user->passwordmd5;
	} else
		if (!empty ($user->password)) {
			// rev 1.6.2 use official hashing technics as per moodle 1.9.7
			//$user->password=md5($user->password);
			$authplugin = get_auth_plugin($user->auth);
			if ($authplugin->prevent_local_passwords()) {
				$user->password = 'not cached';
			} else {
				$user->password = hash_internal_user_password($user->password);
			}
		}
	unset ($user->passwordmd5); //must unset it even if empty ( still there !)
	//first check for required values
	if ($newuser) {

		$required = array (
			'username',
			'email',
			'firstname',
			'lastname',
			'idnumber',
			'password'
		);
		ws_fixuserrecord($user);
		foreach ($required as $field) {
			if (empty ($user-> $field))
				$errmsg .= get_string('ws_missingvalue', 'local_wspp', $field);
			else {
				$user-> $field = trim($user-> $field);
				if (empty ($user-> $field))
					$errmsg .= " " . get_string('ws_missingvalue', 'local_wspp', $field);
			}
		}
		if ($errmsg)
			return $errmsg;
		//check new username does not exist
		if (ws_record_exists('user', 'username', $user->username, 'mnethostid', $user->mnethostid)) {
			$errmsg = get_string('usernameexists'). " ".$user->username;
		}
		if (!empty ($user->id))
			unset ($user->id);
        // rev 1.7
        if (empty($user->lang))
                 $user->lang = $CFG->lang;

        // rev 1.8 23/02/2011
        if (empty($user->country))
            $user->country= empty($CFG->country)? '':$CFG->country;
        if (empty($user->city))
            $user->city= empty($CFG->defaultcity)? '':$CFG->defaultcity; //Moodle 2.02 has this field

	} else {
		if (empty ($user->id))
			$errmsg = get_string('ws_missingvalue', 'local_wspp', 'id');
		else
			if (!ws_record_exists('user', 'id', $user->id)) {
				$errmsg = get_string('ws_userunknown', 'local_wspp', $user->id);
			}
	}
	if ($errmsg)
		return $errmsg;

	//check for other collisions in database

	if (!empty ($user->idnumber)) {
		if ($collision = ws_get_record('user', 'idnumber', $user->idnumber)) {
			if (empty ($user->id) || ($user->id != $collision->id))
				$errmsg = get_string('ws_useridnumberexists', 'local_wspp', $user->idnumber);
		}

	}

	if (!empty ($user->email)) {
		if (!validate_email($user->email)) {
			$errmsg .= " " . get_string('invalidemail');
		} else
			if ($collision = ws_get_record('user', 'email', $user->email, 'mnethostid', $CFG->mnet_localhost_id)) {
				if (empty ($user->id) || ($user->id != $collision->id))
					$errmsg .= " " .
					get_string('emailexists') . " " . $user->email;
			}
	}

	return $errmsg;
}

function ws_checkcourserecord(& $course, $newcourse) {

	global $CFG;

	$errmsg = "";
	unset ($course->action); // remove it
	if ($newcourse) {
		$required = array (
			'shortname',
			'fullname',
			'idnumber'
		);
		ws_fixcourserecord($course);
		foreach ($required as $field) {
			if (empty ($course-> $field))
				$errmsg .= get_string('ws_missingvalue', 'local_wspp', $field);
			else {
				$course-> $field = trim($course-> $field);
				if (empty ($course-> $field))
					$errmsg .= " " . get_string('ws_missingvalue', 'local_wspp', $field);
			}
		}
		//make sure it will go in one category
		if (empty ($CFG->defaultrequestcategory) or !ws_record_exists('course_categories', 'id', $CFG->defaultrequestcategory)) {
			/// default to first top level directory, hacky but means things don't break
			$CFG->defaultrequestcategory = ws_get_field('course_categories', 'id', 'parent', '0');
		}

		if (empty ($course->category) or !ws_record_exists('course_categories', 'id', $course->category)) {
			/// default to first top level directory, hacky but means things don't break
			$course->category = $CFG->defaultrequestcategory;
        }
	    if (!empty ($course->id))
				unset ($course->id);
        //rev 1.7
        if (empty($course->lang))
            $course->lang=$CFG->lang;

	} else {
		if (empty ($course->id))
			$errmsg = get_string('ws_missingvalue', 'local_wspp', 'id');
		else
			if (!ws_record_exists('course', 'id', $course->id)) {
				$errmsg = get_string('ws_courseunknown', 'local_wspp', $course->id);
			}

	}
	if ($errmsg)
		return $errmsg;

	//check for other collisions in database
	if (!empty ($course->shortname)) {
		if ($collision = ws_get_record('course', 'shortname', $course->shortname)) {
			if (empty ($course->id) || ($course->id != $collision->id))
				$errmsg = get_string('shortnametaken') .
				" " . $course->shortname;
		}
	}

	if (!empty ($course->idnumber)) {
		if ($collision = ws_get_record('course', 'idnumber', $course->idnumber)) {
			if (empty ($course->id) || ($course->id != $collision->id))
				$errmsg .= " " .
				get_string('ws_courseidnumberexists', 'local_wspp', $course->idnumber);
		}

	}
	return $errmsg;
}

/**
 * perform all needed operations to insert an activity module into an existing course section
 * @param int $modid
 * @param string  $modtype
 * @param section $section
 * @return string $errmsg
 */

function ws_add_mod_to_section($modid, $modtype, $section, $groupmode = 0, $visible = 1) {
    
    global $CFG;
    
	if (!$module = ws_get_record("modules", "name", $modtype)) {
		return get_string('ws_moduletypeunknown', 'local_wspp', $modtype);
	}
	$a = new StdClass();
	$a->type = $modtype;
	$a->id = $modid;
	//verify if this module is already assigned to any section
	if ($isAssigned = ws_get_record("course_modules", "module", $module->id, "instance", $modid)) {
		$a->section = $isAssigned->section;
		$a->course = $isAssigned->course;
		return get_string('ws_modalreadyassigned', 'local_wspp', $a);
	}

	$course_module = new StdClass();
	$course_module->instance = $modid;
	$course_module->module = $module->id;
	$course_module->course = $section->course;
	$course_module->section = $section->id;
	$course_module->groupmode = $groupmode;
	$course_module->visible = $visible;
	// needed in Moodle 2.x, not in 1.9x 
	require_once ($CFG->dirroot.'/course/lib.php');
	if (!$course_module_id = add_course_module($course_module)) {
		$a->course = $section->course;
		return get_string('ws_erroraddingmoduletocourse', 'local_wspp', $a);
	}
	$course_module->coursemodule = $course_module_id;
	$course_module->section = $section->section;
	//affect the module to the section
	if (!add_mod_to_section($course_module)) {

		$a->section = $section->id;
		return get_string('ws_erroraddingmoduletosection', 'local_wspp', $a);
	}
	 if ($CFG->wspp_using_moodle20)
		rebuild_course_cache($section->course);
	return "";
}



/**
 * take care on renamed database fields from Moodle 1.9 to 2.0
 * to be called on all input record ( type xxxdatum)
 */

function ws_fix_renamed_fields (&$inputRecord,$type) {
    global $CFG;
    if (!$CFG->wspp_using_moodle20) return;

    switch ($type) {

         case "assignment" :
                $inputRecord->intro=$inputRecord->description;
                 unset($inputRecord->description);
                if (isset($inputRecord->format)) {
                    $inputRecord->introformat=$inputRecord->format;
                    unset($inputRecord->format);
                }
            break;

        case "label" :
            $inputRecord->intro=$inputRecord->content;
            unset($inputRecord->content);
            break;

        case "resource" :
            $inputRecord->intro=$inputRecord->summary;
            unset($inputRecord->summary);
            break;

         default :
            break;

    }


}


/**
 * Returns an array of all the active instances of a particular module in given courses, sorted in the order they are defined
 *
 * THIS FUNCTION replace the function in lib/datalib.php by NOT calling get_fast_modinfo  that gives
 * and endless loop if called in a loop for this WebService
 *
 * Returns an array of all the active instances of a particular
 * module in given courses, sorted in the order they are defined
 * in the course. Returns an empty array on any errors.
 *
 * The returned objects includle the columns cw.section, cm.visible,
 * cm.groupmode and cm.groupingid, cm.groupmembersonly, and are indexed by cm.id.
 *
 * @param string $modulename The name of the module to get instances for
 * @param array $courses an array of course objects.
 * @return array of module instance objects, including some extra fields from the course_modules
 *          and course_sections tables, or an empty array if an error occurred.
 */
function ws_get_all_instances_in_courses($modulename, $courses, $userid=NULL, $includeinvisible=false) {
    global $CFG;

    $outputarray = array();

    if (empty($courses) || !is_array($courses) || count($courses) == 0) {
        return $outputarray;
    }

    if (!$rawmods = ws_get_records_sql("SELECT cm.id AS coursemodule, m.*, cw.section, cm.visible AS visible,
                                            cm.groupmode, cm.groupingid, cm.groupmembersonly
                                       FROM {$CFG->prefix}course_modules cm,
                                            {$CFG->prefix}course_sections cw,
                                            {$CFG->prefix}modules md,
                                            {$CFG->prefix}$modulename m
                                      WHERE cm.course IN (".implode(',',array_keys($courses)).") AND
                                            cm.instance = m.id AND
                                            cm.section = cw.id AND
                                            md.name = '$modulename' AND
                                            md.id = cm.module")) {
        return $outputarray;
    }
    return $rawmods;
/*****
 * THIS CODE is commented out since it make the WS die if called with a large amount of courses
    require_once($CFG->dirroot.'/course/lib.php');

    foreach ($courses as $course) {
        $modinfo = get_fast_modinfo($course, $userid);

        if (empty($modinfo->instances[$modulename])) {
            continue;
        }

        foreach ($modinfo->instances[$modulename] as $cm) {
            if (!$includeinvisible and !$cm->uservisible) {
                continue;
            }
            if (!isset($rawmods[$cm->id])) {
                continue;
            }
            $instance = $rawmods[$cm->id];
            if (!empty($cm->extra)) {
                $instance->extra = urlencode($cm->extra); // bc compatibility
            }
            $outputarray[] = $instance;
        }
    }

    return $outputarray;
***/
}



?>
