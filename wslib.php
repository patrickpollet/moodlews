<?php


// $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $

/**
 * utilities functions
 *
 * @package Web Services
 * @version $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.6
 */

/*
 *return primary role of userid in course
 *@param course $course an existing course record
 *@param integer $userid :id of an existing user
 *
 */
 function ws_get_primaryrole_incourse($course,$userid) {
        $context = get_context_instance(CONTEXT_COURSE, $course->id);
        $context_cat= get_context_instance(CONTEXT_COURSECAT, $course->category);
        if (has_capability('moodle/category:manage', $context_cat,$userid))
            return 1;
        if (has_capability('moodle/course:create', $context_cat,$userid))
            return 2;
        if (has_capability('moodle/course:update', $context,$userid))
            return 3;
        if (has_capability('moodle/course:viewhiddenactivities', $context,$userid))
            return 4;
        //student
        // strange : guest may has also the course:view capability ?
        // so we treat it before regular student
        //guest
        if (has_capability('moodle/legacy:guest', $context, $userid, false))
            return 6;
        if (has_capability('moodle/course:view', $context, $userid, false))
            return 5;
        return 0;
    }


 /**
  * add admin default values to empty fields of a course
  */
 function ws_fixcourserecord (&$course) {

	 // ajout defaut de la conf globale
	 $courseconfig = get_config('moodlecourse');
	 foreach($courseconfig as $key=>$value) {
		 if (empty($course->$key))
			 $course->$key=$value;
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
function ws_fixuserrecord(&$user) {
	global $CFG;
	// prep a few params
	$user->modified   = time();
	//Moodle 1.8 and later (a required field that must be non 0 for login )
	if (!empty ($CFG->mnet_localhost_id))
		if (empty ($user->mnethostid)) //if not set by caller
			$user->mnethostid = $CFG->mnet_localhost_id; // always local user
	if (empty ($user->confirmed)) {
		$user->confirmed = true;
	}
    if (!empty($user->password))
        $user->password = hash_internal_user_password($user->password);

	if (empty($user->auth))
		$user->auth = 'manual';
	if (empty($user->lang)) {
		$user->lang = $CFG->lang;
	}
	$user = addslashes_recursive($user);
}

/**
 *
 */

function ws_checkuserrecord(&$user,$newuser) {
	global $CFG;
	$errmsg="";
     unset($course->action); // remove it
	//first check for required values
	if ($newuser) {
		$required=array('username','email','firstname','lastname','idnumber');
		ws_fixuserrecord($user);
		foreach ($required as $field) {
			if (empty($user->$field))
				$errmsg .=get_string('ws_missingvalue','wspp',$field);
			else {
				$user->$field=trim($user->$field);
				if (empty($user->$field))
					$errmsg .=" ".get_string('ws_missingvalue','wspp',$field);
			}
		}
		if ($errmsg) return $errmsg;
		//check new username does not exist
		if (record_exists('user', 'username', $user->username, 'mnethostid', $user->mnet_localhost_id)) {
			$errmsg = get_string('usernameexists');
		}
		if (!empty($user->id)) unset($user->id);

	} else {
		if (empty($user->id))
			$errmsg=get_string('ws_missingvalue','wspp','id');
		else if  (! record_exists('user','id',$user->id)) {
			$errmsg =get_string ('ws_userunknown','wspp',$user->id);
		}
	}
	if ($errmsg) return $errmsg;

	//check for other collisions in database

    if (!empty($user->idnumber)) {
        if ($collision=get_record('user', 'idnumber', $user->idnumber)) {
            if (!empty($user->id) && $user->id !=$collision->id)
                $errmsg=get_string('ws_useridnumberexists','wspp',$user->idnumber);
        }

    }

	if (!empty($user->email)) {
		if (!validate_email($user->email)) {
			$errmsg.=" ".get_string('invalidemail');
		} else if ($collision=get_record('user', 'email', $user->email, 'mnethostid', $CFG->mnet_localhost_id)) {
			if (!empty($user->id) && $user->id !=$collision->id)
				$errmsg=get_string('emailexists')." ".$user->email;
		}
	}
	return $errmsg;
}




function ws_checkcourserecord(&$course,$newcourse) {

    global $CFG;

	$errmsg="";
    unset($course->action); // remove it
	if ($newcourse) {
	    $required=array('shortname','fullname','idnumber');
        ws_fixcourserecord($course);
    	foreach ($required as $field) {
			if (empty($course->$field))
				$errmsg .=get_string('ws_missingvalue','wspp',$field);
			else {
				$course->$field=trim($course->$field);
				if (empty($course->$field))
					$errmsg .=" ".get_string('ws_missingvalue','wspp',$field);
			}
		}
        //make sure it will go in one category
       if (empty($CFG->defaultrequestcategory) or !record_exists('course_categories', 'id', $CFG->defaultrequestcategory)) {
        /// default to first top level directory, hacky but means things don't break
            $CFG->defaultrequestcategory = get_field('course_categories', 'id', 'parent', '0');
        }

        if (empty($course->category) or !record_exists('course_categories', 'id', $course->category)) {
        /// default to first top level directory, hacky but means things don't break
            $course->category =$CFG->defaultrequestcategory;

        if (!empty($course->id)) unset($course->id);
        }

	} else {
        if (empty($course->id))
            $errmsg=get_string('ws_missingvalue','wspp','id');
        else if  (! record_exists('course','id',$course->id)) {
            $errmsg =get_string ('ws_courseunknown','wspp',$course->id);
        }

	}
    if ($errmsg) return $errmsg;

    //check for other collisions in database
    if (!empty($course->shortname)) {
        if ($collision=get_record('course', 'shortname', $course->shortname)) {
            if (!empty($course->id) && $course->id !=$collision->id)
                $errmsg=get_string('shortnametaken')." ".$course->shortname;
        }
    }

     if (!empty($course->idnumber)) {
        if ($collision=get_record('course', 'idnumber', $course->idnumber)) {
            if (!empty($course->id) && $course->id !=$collision->id)
                $errmsg=get_string('ws_courseidnumberexists','wspp',$course->idnumber);
        }

    }

    return $errmsg;



}

?>
