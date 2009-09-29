<?php // $Id: atilib.php,v 1.0.1 2008/03/27 12:21:35 kendev Exp $

///////////////////////////////////////////////////////////////////////////
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// atilib.php															 //
//																		 //
//          http://adnocatilms/atilms                                       //
//                                                                       //
// Copyright (C) 2008 onwards  Ken DeVellis  http://globalnetu.com       //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Library of functions for ati - both public and internal
 *
 * @author Ken DeVellis
 * @version  $Id: atilib.php,v 1.0 2008/03/24 12:21:35 kendev Exp $
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package atilib
 */

require_once $CFG->dirroot.'/group/lib.php';

/////////////////////////////////////////////////////////////////////
/////                  Start of public API                      /////
/////////////////////////////////////////////////////////////////////


/**
 * Adds a specified user to a group in the assessment course and associated project courses
 * @param string $coursename   The SIS short course name (e.g. ENGF304)
 * @param string $username  The users LMS username  (e.g. 601208, ct3025)
 * @param int $atigroup  ATI group number (e.g. 1,2,3...)
 * @return boolean True if user added successfully or the user is already a
 * member of the group(s), false otherwise.
 */

function ati_group_assign($coursename,$username,$atigroup) {

	global $CFG;
	$groupid = 0;
	$retvalue = true;

	// Append the atigroup to the coursename (e.g. ENFG304.5)

	$groupname = $coursename.".".strval($atigroup);

	// also need the actual id for the user

	$userrec = get_record('user', 'username', $username);
	if (!$userrec) return false;
	$userid =  $userrec->id;

// first - get the parent category of the $coursename

	// get the course so we can get its category

	$course = get_record('course', 'idnumber', $coursename);
	if (!$course) return false;

// second - get all the course ids for courses in the above category

	$courseids = get_records_sql("SELECT crs.id
    								FROM {$CFG->prefix}course crs
    								WHERE crs.category = $course->category");
	if (!$courseids) return false;

// third - for each course id, find the groupid and add the user

	foreach ($courseids as $key=>$value)
	{
		$groupid = groups_get_group_by_name($key,$groupname);
		if ($groupid) {
			$retok = groups_add_member($groupid,$userid);
			if (!$retok) $retvalue = false;
		}
	}

	return $retvalue;
}

/**
 * Removes a specified user from a group in the assessment course and associated project courses
 * @param string $coursename   The SIS short course name (e.g. ENGF304)
 * @param string $username  The users LMS username  (e.g. 601208, ct3025)
 * @param int $atigroup  ATI group number (e.g. 1,2,3...)
 * @return boolean True if user removed successfully or the user is not a
 * member of the group(s), false otherwise.
 */


function ati_group_unassign($coursename,$username,$atigroup) {

	global $CFG;
	$groupid = 0;
	$retvalue = true;

	// Append the atigroup to the coursename (e.g. ENFG304.5)

	$groupname = $coursename.".".strval($atigroup);

	// also need the actual id for the user

	$userrec = get_record('user', 'username', $username);
	if (!$userrec) return false;
	$userid =  $userrec->id;

// first - get the parent category of the $coursename

	// get the course so we can get its category

	$course = get_record('course', 'idnumber', $coursename);
	if (!$course) return false;

// second - get all the course ids for courses in the above category

	$courseids = get_records_sql("SELECT crs.id
    								FROM {$CFG->prefix}course crs
    								WHERE crs.category = $course->category");
	if (!$courseids) return false;

// third - for each course id, find the groupid and remove the user

	foreach ($courseids as $key=>$value)
	{
		$groupid = groups_get_group_by_name($key,$groupname);
		if ($groupid) {
			$retok = groups_remove_member($groupid,$userid);
			if (!$retok) $retvalue = false;
		}
	}

	return $retvalue;
}


/**
*   Resets a course - version .9 :)
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $coursename The SIS short course name that the group exists in
     * @param string $newstartdate The new course start date
     * @param boolean $allincat All courses in the same category will be reset if true
     * @param boolean $stuonly Only the students will be unenrolled, not the instructors if true
     * @return boolean true = successful
*/

function ati_reset_course($coursename, $newstartdate, $allincat, $stuonly) {

		global $CFG;
		$groupid = 0;
		$retvalue = true;
		$rolesa = array();

		require_once($CFG->libdir . '/moodlelib.php');

// first - get the course to obtain the courseid and category

		$course = get_record('course', 'idnumber', $coursename);
		if (!$course) return false;

// second - from the category, get the category's context

		$context_record = get_context_instance(CONTEXT_COURSECAT, $course->category);
		if (!$context_record) return false;

// third - get all the course ids for courses in the above category

		$courseids = get_records_sql("SELECT crs.id
    								FROM {$CFG->prefix}course crs
    								WHERE crs.category = $course->category");
		if (!$courseids) return false;

// finally - get the context category id from the context record
		$context_category = $context_record->id;
		if (!$context_category) return false;


//  set the $data object to values normally selected in the reset_form for a course

//			$data->MAX_FILE_SIZE;
			$data->reset_start_date = 0;
//			$data->reset_start_date_old = $newstartdate;		// example '1177790400'
			$data->reset_events = 1;
			$data->reset_logs = 1;
			$data->reset_notes = 1;
			$data->reset_roles[0] = 5;	// student

			if ($stuonly == false) {
				$data->reset_roles[1] = 3;	// teacher
				$data->reset_roles[2] = 4;	// non-editing teacher
			}

			$data->reset_roles_overrides = 1;
			$data->reset_roles_local = 1;
			$data->reset_gradebook_grades = 1;
			$data->reset_reset_groups_members = 1;
			$data->reset_assignment_submissions = 1;	// tbd: generalize this to include
			$data->reset_quiz_attempts = 1;				//		all relevant activities

			// now, reset each course in the category

			foreach ($courseids as $key=>$value)
			{
				$data->id = $courseids[$key]->id;	// get the next course id

			// reset each course in the category
				$retvalue = reset_course_userdata($data);

			// remove all members from all groups for each course in the category
			// (this moodle function always returns true for some reason...)
				$retvalue = groups_delete_group_members($key);
			}

//  next, unassign all roles from the category - tbd: use the $stuonly parameter

			$rolesa[0] = 2;
			$rolesa[1] = 3;
			$rolesa[2] = 4;
			$rolesa[3] = 5;
			$rolesa[4] = 6;
			$rolesa[5] = 7;
			$rolesa[6] = 8;

// get userids for all users with roles in category

	$le_users_with_roles = get_role_users($rolesa, $context_record, $parent=false, $fields='', $sort='u.lastname ASC', $gethidden=true, $group='', $limitfrom='', $limitnum='') ;

	foreach ($le_users_with_roles as $key=>$value)

	{
		if (!role_unassign(0,$le_users_with_roles[$key]->id,$groupid,$context_category))
		{
			//	should probably do something here...
		}
	}

	return true;	// version .9 :)

}


?>
