<?php


// $Id$

/**
 * utilities function to filter off resuts not available to current WS user
 * or to add extra fields required in the wsdl
 * or to match WSDLfields names with actual DB names (eg changes from 1.9 to 2.0)
 *
 * @package Web Services
 * @version $Id$
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.6
 */

/*
 *
 * rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
 * so we check for error before calling get_context_instance in all filter_* operation
*/
function filter_forum($client, $forum) {
     global $CFG;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($forum->error))
        return $forum;
    if (!$cm = get_coursemodule_from_instance("forum", $forum->id, $forum->course))
        return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/forum:viewdiscussion', $context))
        return false;
    return $forum;
}

function filter_forums($client, $forums) {
    $res = array ();
    foreach ($forums as $forum) {
        $forum = filter_forum($client, $forum);
        if ($forum) {
            $res[] = $forum;
        }
    }
    return $res;
}

function filter_wiki($client, $wiki) {
     global $CFG;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($wiki->error))
        return $wiki;
    if (!$cm = get_coursemodule_from_instance("wiki", $wiki->id, $wiki->course))
        return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/wiki:participate', $context))
        return false;
    return $wiki;

}
function filter_wikis($client, $wikis) {
    $res = array ();
    foreach ($wikis as $wiki) {
        $wiki = filter_wiki($client, $wiki);
        if ($wiki) {
            $res[] = $wiki;
        }
    }
    return $res;
}

function filter_pagewiki($client, $pagewiki) {
     global $CFG;
    //todo return only those where user is teacher
    //$uid = $this->get_session_user($client);
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($pagewiki->error))
        return $pagewiki;
    if (!$wiki = ws_get_record("wiki", "id", $pagewiki->wiki)) {
        return false; //orphaned ????;
    }
    if (!$course = ws_get_record("course", "id", $wiki->course)) {
        return false;
    }
    if (!$cm = get_coursemodule_from_instance("wiki", $wiki->id, $course->id)) {
        return false;
    }
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/wiki:participate', $context))
        return false;

    return $pagewiki;
}

function filter_pagesWiki($client, $pagesWiki) {
    $res = array ();
    foreach ($pagesWiki as $pagewiki) {
        $pagewiki = filter_pagewiki($client, $pagewiki);
        if ($pagewiki) {
            $res[] = $pagewiki;
        }
    }
    return $res;
}

function filter_assignment($client, $assignment) {
    global $CFG;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($assignment->error))
        return $assignment;
    if (!$cm = get_coursemodule_from_instance("assignment", $assignment->id, $assignment->course))
        return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/assignment:view', $context))
        return false;
     //fields renamed in Moodle 2.0
     if ($CFG->wspp_using_moodle20) {
        $assignment->description=$assignment->intro;
        $assignment->format=$assignment->introformat;
     }
    return $assignment;
}

function filter_assignments($client, $assignments) {
    $res = array ();
    foreach ($assignments as $assignment) {
        $assignment = filter_assignment($client, $assignment);
        if ($assignment) {
            $res[] = $assignment;
        }
    }
    return $res;
}

function filter_database($client, $database) {
     global $CFG;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($database->error))
        return $database;
    if (!$cm = get_coursemodule_from_instance("data", $database->id, $database->course))
        return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/data:viewentry', $context))
        return false;
    return $database;
}

function filter_databases($client, $databases) {
    $res = array ();
    foreach ($databases as $database) {
        $database = filter_database($client, $database);
        if ($database) {
            $res[] = $database;
        }
    }
    return $res;
}

function filter_label($client, $label) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($label->error))
        return $label;
    $context = get_context_instance(CONTEXT_COURSE, $label->course);
    if (!ws_is_enrolled($label->course, $USER->id)) {
        return $label;
    }
     //name has changed in Moodle 2.0
    if ($CFG->wspp_using_moodle20) {
        $label->content=$label->intro;
     }
    return $label;
}

function filter_labels($client, $labels) {
    $res = array ();
    foreach ($labels as $label) {
        $label = filter_label($client, $label);
        if ($label) {
            $res[] = $label;
        }
    }
    return $res;
}

/**
* these function mask attributes or remove records depending of logged-in user rights
*/
function filter_user($client, $user, $role) {
    global $CFG;
    /**   COMMENTED OUT TO ALOW UNDELETE ati OPERTAION
    if (!empty($user->deleted))
        return false;
    */
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($user->error))
        return $user;
    if ($user->emailstop)
        $user->email = "not disclosed by user's will";
    $user->password = ''; //no way, even in  md5, can be cracked by reverse dictionnary
    if (empty ($user->role))
        $user->role = $role; // add a basic role info if available (see get_users_bycourse)
    // rev 1.6.4 add custom profile fields to user record as and array of (name,value) tuples
    require_once ($CFG->dirroot . '/user/profile/lib.php');
    $fields = profile_user_record($user->id);

    $ret = array ();
    foreach ($fields as $name => $value) {
        $tmp = new profileitemRecord();
        $tmp->setName($name);
        $tmp->setValue($value);
        $ret[] = $tmp;
    }
    $user->profile = $ret;

    return $user;
}

function filter_users($client, $users, $role) {
    $res = array ();
    foreach ($users as $user) {
        $user = filter_user($client, $user, $role);
        if ($user)
            $res[] = $user;
    }
    return $res;
}

function filter_course($client, $course) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($course->error))
        return $course;
    //return false if not visible to $client
    // check capability , course maybe non visible
    //TODO ajouter ici le role primaire ;-)
    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    if (has_capability('moodle/course:update', $context))
        return $course;
    if (ws_is_enrolled($course->id, $USER->id)) {
        $course->password = ''; // do not disclose it to non teacher
        return $course;
    }
    return $course->visible ? $course : false;
}

function filter_courses($client, $courses) {
    $res = array ();
    foreach ($courses as $course) {
        $course = filter_course($client, $course);
        if ($course)
            $res[] = $course;
    }
    return $res;
}

function filter_category($client, $category) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($category->error))
        return $category;
    //return false if not visible to $client
    $context = get_context_instance(CONTEXT_COURSECAT, $category->id);
    if (!$category->visible) {
        if (!has_capability('moodle/category:viewhiddencategories', $context))
            return false;
    }

    return $category;

}

function filter_categories($client, $categories) {
    $res = array ();
    foreach ($categories as $category) {
        $category = filter_category($client, $category);
        if ($category)
            $res[] = $category;
    }
    return $res;
}

function filter_group($client, $group) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($group->error))
        return $group;
    // check user's membership to this group ?
    $context = get_context_instance(CONTEXT_COURSE, $group->courseid);
    if (has_capability('moodle/course:update', $context))
        return $group;
    if (!ws_is_enrolled($group->courseid, $USER->id))
        return false;
    $group->enrolmentkey = '';
    return $group;
}

function filter_groups($client, $groups) {
    $res = array ();
    foreach ($groups as $group) {
        $group = filter_group($client, $group);
        if ($group)
            $res[] = $group;
    }
    return $res;
}

function filter_grouping($client, $group) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($group->error))
        return $group;
    // check user's membership to this group ?
    $context = get_context_instance(CONTEXT_COURSE, $group->courseid);
    if (has_capability('moodle/course:update', $context))
        return $group;
    if (!ws_is_enrolled($group->courseid, $USER->id))
        return false;
    $group->configdata = '';
    return $group;
}

function filter_groupings($client, $groups) {
    $res = array ();
    foreach ($groups as $group) {
        $group = filter_grouping($client, $group);
        if ($group)
            $res[] = $group;
    }
    return $res;
}

function filter_cohort($client, $group) {
    global $CFG,$USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($group->error))
        return $group;
    $context = get_context_instance_by_id($group->contextid);
    if (has_capability('moodle/cohort:manage', $context))
        return $group;
    return false;
}

function filter_cohorts($client, $groups) {
    $res = array ();
    foreach ($groups as $group) {
        $group = filter_cohort($client, $group);
        if ($group)
            $res[] = $group;
    }
    return $res;
}

function filter_resource($client, $resource) {
    global $CFG,$USER;
    if (!empty ($resource->error))
        return $resource;
    $resource->timemodified_ut = userdate($resource->timemodified);


    //name has changed in Moodle 2.0
    if ($CFG->wspp_using_moodle20) {
        $resource->summary=$resource->intro;
    }

    //return false if resource->visible is false AND $client not "teacher"
    $context = get_context_instance(CONTEXT_COURSE, $resource->course);
    //if (has_capability('moodle/course:update', $context))
    // 1.6.3  there is a special capability for hiddensection
    if (has_capability('moodle/course:viewhiddenactivities', $context))
        return $resource;
    if (!ws_is_enrolled($resource->course, $USER->id))
        return false;
    return $resource->visible ? $resource : false;
}

function filter_resources($client, $resources) {
    $res = array ();
    foreach ($resources as $resource) {
        $resource = filter_resource($client, $resource);
        if ($resource)
            $res[] = $resource;
    }
    return $res;
}


function filter_instance($client, $resource,$type) {
    global $CFG,$USER;
    if (!empty ($resource->error))
        return $resource;
    $resource->timemodified_ut = userdate($resource->timemodified);


    //name may has changed in Moodle 2.0
    if ($CFG->wspp_using_moodle20) {
        //$resource->summary=$resource->intro;
    }

    //return false if resource->visible is false AND $client not "teacher"
    $context = get_context_instance(CONTEXT_COURSE, $resource->course);
    //if (has_capability('moodle/course:update', $context))
    // 1.6.3  there is a special capability for hiddensection
    if (has_capability('moodle/course:viewhiddenactivities', $context))
        return $resource;
    if (!ws_is_enrolled($resource->course, $USER->id))
        return false;
    return $resource->visible ? $resource : false;
}




function filter_instances($client, $resources,$type) {
    $res = array ();
    foreach ($resources as $resource) {
        $resource = filter_instance($client, $resource,$type);
        if ($resource)
            $res[] = $resource;
    }
    return $res;
}




function filter_section($client, $section) {
    global $CFG,$USER;
    if (!empty ($section->error))
        return $section;
    $context = get_context_instance(CONTEXT_COURSE, $section->course);
    //if (has_capability('moodle/course:update', $context))
    // 1.6.3  there is a special capability for hiddensection
    if (has_capability('moodle/course:viewhiddensections', $context))
        return $section;
    if (!ws_is_enrolled($section->course, $USER->id))
        return false;
    return $section->visible ? $section : false;
}

function filter_sections($client, $sections) {
    $res = array ();
    foreach ($sections as $section) {
        $section = filter_section($client, $section);
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
        $activity = filter_activity($client, $activity);
        if ($activity)
            $res[] = $activity;
    }
    return $res;
}

/**
 * remove empty grades and fix null feedbacks
 */
function filter_grade($client, $grade) {
    if (!empty ($grade->error))
        return $grade;
    if (empty ($grade->grade))
        return false;
    if (empty ($grade->feedback))
        $grade->feedback = "";
    return $grade;
}
function filter_grades($client, $grades) {
    $res = array ();
    foreach ($grades as $grade) {
        $grade = filter_grade($client, $grade);
        if ($grade) {
            $res[] = $grade;
        }
    }
    return $res;
}

function filter_change($client, $change) {
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($change->error))
        return $change;
    //return false if ressource changed is not visible to $client
    $context = get_context_instance(CONTEXT_COURSE, $change->courseid);
    if (has_capability('moodle/course:update', $context))
        return $change;
    return $change->visible ? $change : false;
}

function filter_changes($client, $changes) {
    $res = array ();
    foreach ($changes as $change) {
        $change = filter_change($client, $change);
        if ($change)
            $res[] = $change;
    }
    return $res;
}

function filter_event($client, $eventype, $event) {
    global $USER;
    // rev. 1.7 Moodle 2.0 now throw an execption if context is invalid (ie courseid==0)
    if (!empty ($event->error))
        return $event;
    if (has_capability("moodle/calendar:manageentries", get_context_instance(CONTEXT_SYSTEM))) // admin user
        return $event;
    switch ($eventype) {
        case cal_show_user :
            if ($event->userid != $USER->id)
                return false;
            else {
                if (has_capability("moodle/calendar:manageownentries", get_context_instance(CONTEXT_SYSTEM)))
                    return $event;
                else
                    return false;
            }
            break;
        case cal_show_group :
            if (!ismember($event->groupeid, $USER->id))
                return false;
            else
                return $event;
            break;
        case cal_show_course :
            //TODO check course rights and visibility
            if (ws_is_enrolled($event->courseid, $USER->id))
                return $event;
            else
                return false;
            break;
        default :
            return $event;
    }
}

function filter_quiz($client, $quiz) {
    return $quiz;
}

function filter_quizzes($client, $quizzes) {
    $res = array ();
    foreach ($quizzes as $quiz) {
        $quiz = filter_quiz($client, $quiz);
        if ($quiz)
            $res[] = $quiz;
    }
    return $res;
}



function filter_message($client, $msg) {

	global $CFG;
	 if (!$CFG->wspp_using_moodle20) {
	 	$msg->fullmessage=$msg->smallmessage=$msg->message;
	 }

    if ($tmpuser = ws_get_record("user", 'id', $msg->useridfrom)) {
        $msg->firstname = $tmpuser->firstname;
        $msg->lastname = $tmpuser->lastname;
        $msg->email = $tmpuser->email;
        $msg->picture = $tmpuser->picture;
        $msg->imagealt = $tmpuser->imagealt;
    }
    return $msg;
}

function filter_messages($client, $msgs) {
    $res = array ();
    foreach ($msgs as $msg) {
        $msg = filter_message($client, $msg);
        if ($msg)
            $res[] = $msg;
    }
    return $res;

}

/**
 * rev 1.8.3 a contact is a regular Moodle user plus tow informations
 * about online status and messages count (see record classes/contactRecord)
 * messagecount has been retrieved in the SQL
 * online is computed here
 */
function filter_contact ($client, $user) {
    global $CFG;
   if (!empty ($user->error))
        return $user;
   // add whatever is needed for regular user
   if (!$user=filter_user($client,$user))
    return false;
    // check status
    $timetoshowusers = 300; //Seconds default
    if (isset($CFG->block_online_users_timetosee)) {
        $timetoshowusers = $CFG->block_online_users_timetosee * 60;
    }
    // time which a user is counting as being active since
    $timefrom = time()-$timetoshowusers;
    $user->online=$user->lastaccess >= $timefrom;
    return $user;

}


function filter_contacts($client, $msgs) {
    $res = array ();
    foreach ($msgs as $msg) {
        $msg = filter_contact($client, $msg);
        if ($msg)
            $res[] = $msg;
    }
    return $res;

}



?>
