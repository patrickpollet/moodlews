<?php

// $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $

/**
 * utilities function to filter off resuts not available to current WS user
 *
 * @package Web Services
 * @version $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.6
 */



function filter_forum($client, $forum) {
	if (!$cm = get_coursemodule_from_instance("forum", $forum->id, $forum->course)) return false;
	$context = get_context_instance(CONTEXT_MODULE, $cm->id);
	if (!has_capability('mod/forum:viewdiscussion', $context))return false;
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
    if (!$cm = get_coursemodule_from_instance("wiki", $wiki->id, $wiki->course)) return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/wiki:participate', $context))return false;
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
	    //todo return only those where user is teacher
	    //$uid = $this->get_session_user($client);
	    if (! $wiki = get_record("wiki", "id", $pagewiki->wiki)) {
		    return false ; //orphaned ????;
	    }
	    if (! $course = get_record("course", "id", $wiki->course)) {
		    return false ;
	    }
	    if (! $cm = get_coursemodule_from_instance("wiki", $wiki->id, $course->id)) {
		    return false;
	    }
	    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
	    if (!has_capability('mod/wiki:participate', $context))return false;

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
    if (!$cm = get_coursemodule_from_instance("assignment", $assignment->id, $assignment->course)) return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/assignment:view', $context))return false;
    return $assignement;
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
    if (!$cm = get_coursemodule_from_instance("data", $database->id, $database->course)) return false;
    $context = get_context_instance(CONTEXT_MODULE, $cm->id);
    if (!has_capability('mod/data:viewentry', $context))return false;
        return $database;
    }

    function filter_databases($client, $databases) {
        $res = array ();
        foreach ($databases as $database) {
            $database =filter_database($client, $database);
            if ($database) {
                $res[] = $database;
            }
        }
        return $res;
    }

        function filter_label($client, $label) {
        $context = get_context_instance(CONTEXT_COURSE, $label->course);
        if (has_capability('moodle/course:view', $context)) {
                return $label;
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
        /**   COMMENTED OUT TO ALOW UNDELETE ati OPERTAION
        if (isset($user->deleted) && $user->deleted)
            return false;
        */
        if ($user->emailstop)
            $user->email = "not disclosed by user's will";
        $user->password = ''; //no way, even in  md5, can be cracked by reverse dictionnary
        if (empty($user->role))
            $user->role= $role; // add a basic role info if available (see get_users_bycourse)
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
        global $USER;
        //return false if not visible to $client
        // check capability , course maybe non visible
        //TODO ajouter ici le role primaire ;-)
        $context = get_context_instance(CONTEXT_COURSE, $course->id);
        if (has_capability('moodle/course:update', $context))
                return $course;
        if (has_capability('moodle/course:view', $context)) {
                $course->password = ''; // do not disclose it to non teacher
                return $course;
        }
        return $course->visible? $course: false;
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
	    global $USER;
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
        // check user's membership to this group ?
         $context = get_context_instance(CONTEXT_COURSE, $group->courseid);
        if (has_capability('moodle/course:update', $context))
                return $group;
        if (! has_capability('moodle/course:view', $context))
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
        // check user's membership to this group ?
         $context = get_context_instance(CONTEXT_COURSE, $group->courseid);
        if (has_capability('moodle/course:update', $context))
                return $group;
        if (! has_capability('moodle/course:view', $context))
                return false;
        $group->confifdata = '';
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


    function filter_resource($client, $resource) {
        if (isset ($resource->error) && $resource->error)
            return $resource;
        $resource->timemodified_ut = userdate($resource->timemodified);
        //return false if resource->visible is false AND $client not "teacher"
        $context = get_context_instance(CONTEXT_COURSE, $resource->course);
        if (has_capability('moodle/course:update', $context))
                return $resource;
        if (! has_capability('moodle/course:view', $context))
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

    function filter_section($client, $section) {

        if (!empty($section->error))
            return $section;
          $context = get_context_instance(CONTEXT_COURSE, $section->course);
        if (has_capability('moodle/course:update', $context))
                return $section;
        if (! has_capability('moodle/course:view', $context))
                return false;
        return $section->visible ? $section : false;
    }


    function filter_sections($client, $sections) {
        $res = array ();
        foreach ($sections as $section) {
            $section =filter_section($client, $section);
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
        if (!empty($grade->error)) return $grade;
        if (empty($grade->grade)) return false;
        if (empty($grade->feedback)) $grade->feedback="";
        return $grade;
    }
    function filter_grades($client,$grades) {
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
        //return false if ressource changed is not visible to $client
         $context = get_context_instance(CONTEXT_COURSE, $change->courseid);
        if (has_capability('moodle/course:update', $context))
                return $change;
        return $change->visible ? $change : false;
    }

    function filter_changes($client, $changes) {
        $res = array ();
        foreach ($changes as $change) {
            $change =filter_change($client, $change);
            if ($change)
                $res[] = $change;
        }
        return $res;
    }


    function filter_event($client, $eventype, $event) {
        global $USER;
        if (has_capability("moodle/calendar:manageentries",get_context_instance(CONTEXT_SYSTEM))) // admin user
            return $event;
        switch ($eventype) {
            case cal_show_user :
                if ($event->userid != $USER->id)
                    return false;
                else {
                    if (has_capability("moodle/calendar:manageownentries",get_context_instance(CONTEXT_SYSTEM)))
                        return $event;
                    else return false;
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
                if (has_capability("moodle/course:view",get_context_instance(CONTEXT_COURSE, $event->courseid)))
                return $event;
                else return false;
                break;
            default :
                return $event;
        }
    }


?>
