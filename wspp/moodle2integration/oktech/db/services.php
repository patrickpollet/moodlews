<?php 




// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see http://www.gnu.org/licenses/

/**
 * OK Tech Web Service service definitions.
 *
 * @package    oktech
 * @copyright  2011 Patrick Pollet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


$functions = array(


  'oktech_add_assignment' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_assignment',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_category' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_category',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 add a single course to Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_database' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_database',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_forum' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_forum',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_grouping' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_grouping',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_label' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_label',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_noneditingteacher' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_noneditingteacher',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " add a non editing teacher role to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_pagewiki' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_pagewiki',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_student' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_student',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " add a student role to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_teacher' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_teacher',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " add a editing teacher role to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_user' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_user',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_add_wiki' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'add_wiki',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_assignment_to_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_assignment_to_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_course_to_category' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_course_to_category',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_database_to_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_database_to_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_forum_to_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_forum_to_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_group_to_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_group_to_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_group_to_grouping' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_group_to_grouping',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_grouping_to_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_grouping_to_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_label_to_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_label_to_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_pageWiki_to_wiki' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_pageWiki_to_wiki',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_section_to_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_section_to_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_user_to_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_user_to_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_user_to_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_user_to_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_user_to_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_user_to_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_users_to_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_users_to_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " add users to a cohort",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_users_to_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_users_to_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " add users to a group",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_affect_wiki_to_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'affect_wiki_to_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_count_activities' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'count_activities',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_count_users_bycourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'count_users_bycourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return the count of  users having role idrole in course idcourse identified by idfield Role id number in mdl_roles table. If empty, all roles are matched",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_delete_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'delete_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 delete a single cohort from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_delete_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'delete_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 delete a single course from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_delete_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'delete_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 delete a single group from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_delete_grouping' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'delete_grouping',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 delete a single group from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_delete_user' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'delete_user',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 delete a single group from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_assignments' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_assignments',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_categories' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_categories',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_courses' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_courses',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find Edit course records (add/update/delete).",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_databases' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_databases',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_forums' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_forums',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_groupings' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_groupings',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_groups' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_groups',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_labels' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_labels',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_pagesWiki' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_pagesWiki',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_sections' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_sections',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_users' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_users',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Edit user records (add/update/delete).",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_edit_wikis' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'edit_wikis',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_enrol_students' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'enrol_students',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Enrol users as a student in the given course. prerequisite : corresponding students records MUST exist in Moodle OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_activities' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_activities',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return all logged actions of user in one course or any course",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_assignments' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_assignments',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_cohorts' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_cohorts',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_databases' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_databases',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_forums' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_forums',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_groupings' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_groupings',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_groups' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_groups',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_labels' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_labels',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_pagesWiki' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_pagesWiki',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_quizzes' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_quizzes',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_all_wikis' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_all_wikis',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_assignment_submissions' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_assignment_submissions',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_boolean_array' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_boolean_array',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_categories' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_categories',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return categories  identified by",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_category_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_category_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return categories Record identified by id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_category_byname' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_category_byname',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return categories Record identified by name",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_cohort_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_cohort_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one groupRecord  identified by Moodles id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_cohort_byidnumber' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_cohort_byidnumber',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one groupRecord  identified by Moodles id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_cohort_members' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_cohort_members',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return members of cohort identified by groupeid (Moodle id )",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_cohorts_byname' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_cohorts_byname',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one groupRecord  identified by Moodles id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return an array of course record having idfield=info can be used for any criteria   eg: in python proxy.get_courses(a,b,visible,0)   note that is that case, only admins and courses teachers will get them",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_course_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_course_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return courseRecord for one course identified by Moodles id info",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_course_byidnumber' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_course_byidnumber',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return courseRecord for one course identified by Moodles idnumber info",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_course_grades' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_course_grades',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return course grades for currently enrolled students  (moodle 1.9)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_courses' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_courses',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of course records. OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_courses_bycategory' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_courses_bycategory',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return courses if category identified by id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_courses_search' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_courses_search',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6.2 find and return a list of courses having search in their name, fullname or description",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_events' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_events',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_float_array' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_float_array',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_grades' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_grades',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return student grades for specified courses  (moodle 1.9) NOTE Courses MUST have an id_number",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_group_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_group_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one groupRecord  identified by Moodles id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_group_members' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_group_members',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return members of group identified by groupeid (Moodle id )",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_grouping_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_grouping_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one groupRecord  identified by Moodles id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_grouping_members' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_grouping_members',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return members of grouping identified by groupeid (Moodle id )",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_groupings_bycourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_groupings_bycourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return the list of groupings of course identified by courseid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_groupings_byname' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_groupings_byname',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one or several groupRecord for groups having name name and (optionally) belonging to course courseid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_groups_bycourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_groups_bycourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return the list of groups of course identified by courseid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_groups_byname' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_groups_byname',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one or several groupRecord for groups having name name and (optionally) belonging to course courseid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_instances_bytype' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_instances_bytype',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of activities within one or several courses. TODO cast returned data to more specific types currently return only a generic description",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_int_array' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_int_array',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_last_changes' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_last_changes',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_message_contacts' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_message_contacts',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "*  rev 1.8 retrieve all contacts of user identified by userid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_messages' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_messages',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "*  rev 1.8 retrieve all unread users messages",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_messages_history' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_messages_history',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "*  rev 1.8 retrieve all unread users messages",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_module_grades' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_module_grades',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " retrieve grades to an activity",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_assignment_grade' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_assignment_grade',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " retrieve my grade to a ass",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_cohorts' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_cohorts',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return cohorts to which user uid belongs to if uid is empty, use current logged in user. otherwise, current logged in user must be admin to fetch data",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_courses' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_courses',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of courses that a user identified by Moodles id is a member of.",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_courses_byidnumber' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_courses_byidnumber',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of courses that a user identified by Moodles idnumber is a member of.",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_courses_byusername' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_courses_byusername',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of courses that a user identified by Moodles username is a member of.",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Return users group(s)  in course identified by courseid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_groups' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_groups',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return groups to which user uid belongs to if uid is empty, use current logged in user. otherwise, current logged in user must be admin to fetch data",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_id' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_id',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Returns current user Moodle interanl id a convenience function added here for WSHelper to find it and publish it in the WSDL",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_module_grade' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_module_grade',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " retrieve my grade to an activity",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_my_quiz_grade' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_my_quiz_grade',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " retrieve my grade to a quiz",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_primaryrole_incourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_primaryrole_incourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " determine the primary role of user in a course",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_quiz' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_quiz',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6.5 added upon request on tstc.edu",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_resourcefile_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_resourcefile_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "*  rev 1.8.3 retrieve a file resource by its id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_resources' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_resources',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of ressources within one or several courses. OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_role_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_role_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one roleRecord identified by its id",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_role_byname' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_role_byname',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return one roleRecord identified by its shortname",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_roles' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_roles',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return all known roles in Moodle or an array of roleRecord having idfield equals to roleid",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_sections' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_sections',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of sections within one or several courses. OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_string_array' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_string_array',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_students' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_students',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return students of a course idcourse identified by idfield rev 1.6.7 role id (4) is not anymore hardcoded",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_teachers' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_teachers',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return teachers and non editing teachers of a course idcourse identified by idfield rev 1.6.7 role ids 3 and 4 are not anymore hardcoded",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_user' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_user',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " get one user record with idfield=userinfo. may return several users records if idfield is not a key eg. proxy.get_user(a,b,alexis,firstname)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_user_byid' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_user_byid',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Get an user record from its id  (the main Moodle id key)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_user_byidnumber' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_user_byidnumber',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Get an user record from its id number (an optional info in Moodle)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_user_byusername' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_user_byusername',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Get an user record from its login name",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_user_grades' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_user_grades',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return student grades for currently enrolled courses  (moodle 1.9)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_users' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_users',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Find and return a list of user records. OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_users_bycourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_users_bycourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return an array of users having role idrole in course idcourse identified by idfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_users_byprofile' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_users_byprofile',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " return an array of users having role idrole in course idcourse identified by idfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_get_version' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'get_version',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " Return WS version.",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_has_role_incourse' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'has_role_incourse',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " determine if user has (at least) a given role in a course",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_message_send' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'message_send',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "*  rev 1.8 send an instant message to user identified if (userid,useridfield)",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_group_from_grouping' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_group_from_grouping',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_noneditingteacher' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_noneditingteacher',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " remove a non editing teacher role  to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_student' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_student',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " remove a student role  to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_teacher' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_teacher',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " remove an editing teacher role to userid identified by useridfield to courseid identified by courseidfield",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_user_from_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_user_from_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_user_from_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_user_from_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_user_from_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_user_from_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_users_from_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_users_from_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " remove users from a cohort",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_remove_users_from_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'remove_users_from_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " remove users from a group",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_set_user_profile_values' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'set_user_profile_values',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_unenrol_students' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'unenrol_students',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " unEnrol users as a student in the given course. prerequisite : corresponding students records MUST exist in Moodle OK PP tested with php5 5 and python clients",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_cohort' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_cohort',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => "* rev 1.7 update a single cohort from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_course' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_course',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 update a single course from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_group' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_group',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 update a single group from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_grouping' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_grouping',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 update a single grouping from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_section' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_section',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 update a single course from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
  'oktech_update_user' => array(
    'classname'   => 'oktech_external',
    'methodname'  => 'update_user',
    'classpath'   => 'local/oktech/externallib.php',
    'description' => " rev 1.6 update a single course from Moodle",
    'type'        => '',
    'capabilities'=> ''   
 ),
 
);


$services = array(
        'oktech WS' => array(
                'functions' => array (
                
 				 		'oktech_add_assignment',
 				 	
 				 		'oktech_add_category',
 				 	
 				 		'oktech_add_cohort',
 				 	
 				 		'oktech_add_course',
 				 	
 				 		'oktech_add_database',
 				 	
 				 		'oktech_add_forum',
 				 	
 				 		'oktech_add_group',
 				 	
 				 		'oktech_add_grouping',
 				 	
 				 		'oktech_add_label',
 				 	
 				 		'oktech_add_noneditingteacher',
 				 	
 				 		'oktech_add_pagewiki',
 				 	
 				 		'oktech_add_section',
 				 	
 				 		'oktech_add_student',
 				 	
 				 		'oktech_add_teacher',
 				 	
 				 		'oktech_add_user',
 				 	
 				 		'oktech_add_wiki',
 				 	
 				 		'oktech_affect_assignment_to_section',
 				 	
 				 		'oktech_affect_course_to_category',
 				 	
 				 		'oktech_affect_database_to_section',
 				 	
 				 		'oktech_affect_forum_to_section',
 				 	
 				 		'oktech_affect_group_to_course',
 				 	
 				 		'oktech_affect_group_to_grouping',
 				 	
 				 		'oktech_affect_grouping_to_course',
 				 	
 				 		'oktech_affect_label_to_section',
 				 	
 				 		'oktech_affect_pageWiki_to_wiki',
 				 	
 				 		'oktech_affect_section_to_course',
 				 	
 				 		'oktech_affect_user_to_cohort',
 				 	
 				 		'oktech_affect_user_to_course',
 				 	
 				 		'oktech_affect_user_to_group',
 				 	
 				 		'oktech_affect_users_to_cohort',
 				 	
 				 		'oktech_affect_users_to_group',
 				 	
 				 		'oktech_affect_wiki_to_section',
 				 	
 				 		'oktech_count_activities',
 				 	
 				 		'oktech_count_users_bycourse',
 				 	
 				 		'oktech_delete_cohort',
 				 	
 				 		'oktech_delete_course',
 				 	
 				 		'oktech_delete_group',
 				 	
 				 		'oktech_delete_grouping',
 				 	
 				 		'oktech_delete_user',
 				 	
 				 		'oktech_edit_assignments',
 				 	
 				 		'oktech_edit_categories',
 				 	
 				 		'oktech_edit_courses',
 				 	
 				 		'oktech_edit_databases',
 				 	
 				 		'oktech_edit_forums',
 				 	
 				 		'oktech_edit_groupings',
 				 	
 				 		'oktech_edit_groups',
 				 	
 				 		'oktech_edit_labels',
 				 	
 				 		'oktech_edit_pagesWiki',
 				 	
 				 		'oktech_edit_sections',
 				 	
 				 		'oktech_edit_users',
 				 	
 				 		'oktech_edit_wikis',
 				 	
 				 		'oktech_enrol_students',
 				 	
 				 		'oktech_forum_add_discussion',
 				 	
 				 		'oktech_forum_add_reply',
 				 	
 				 		'oktech_get_activities',
 				 	
 				 		'oktech_get_all_assignments',
 				 	
 				 		'oktech_get_all_cohorts',
 				 	
 				 		'oktech_get_all_databases',
 				 	
 				 		'oktech_get_all_forums',
 				 	
 				 		'oktech_get_all_groupings',
 				 	
 				 		'oktech_get_all_groups',
 				 	
 				 		'oktech_get_all_labels',
 				 	
 				 		'oktech_get_all_pagesWiki',
 				 	
 				 		'oktech_get_all_quizzes',
 				 	
 				 		'oktech_get_all_wikis',
 				 	
 				 		'oktech_get_assignment_submissions',
 				 	
 				 		'oktech_get_boolean_array',
 				 	
 				 		'oktech_get_categories',
 				 	
 				 		'oktech_get_category_byid',
 				 	
 				 		'oktech_get_category_byname',
 				 	
 				 		'oktech_get_cohort_byid',
 				 	
 				 		'oktech_get_cohort_byidnumber',
 				 	
 				 		'oktech_get_cohort_members',
 				 	
 				 		'oktech_get_cohorts_byname',
 				 	
 				 		'oktech_get_course',
 				 	
 				 		'oktech_get_course_byid',
 				 	
 				 		'oktech_get_course_byidnumber',
 				 	
 				 		'oktech_get_course_grades',
 				 	
 				 		'oktech_get_courses',
 				 	
 				 		'oktech_get_courses_bycategory',
 				 	
 				 		'oktech_get_courses_search',
 				 	
 				 		'oktech_get_events',
 				 	
 				 		'oktech_get_float_array',
 				 	
 				 		'oktech_get_forum_discussions',
 				 	
 				 		'oktech_get_forum_posts',
 				 	
 				 		'oktech_get_grades',
 				 	
 				 		'oktech_get_group_byid',
 				 	
 				 		'oktech_get_group_members',
 				 	
 				 		'oktech_get_grouping_byid',
 				 	
 				 		'oktech_get_grouping_members',
 				 	
 				 		'oktech_get_groupings_bycourse',
 				 	
 				 		'oktech_get_groupings_byname',
 				 	
 				 		'oktech_get_groups_bycourse',
 				 	
 				 		'oktech_get_groups_byname',
 				 	
 				 		'oktech_get_instances_bytype',
 				 	
 				 		'oktech_get_int_array',
 				 	
 				 		'oktech_get_last_changes',
 				 	
 				 		'oktech_get_message_contacts',
 				 	
 				 		'oktech_get_messages',
 				 	
 				 		'oktech_get_messages_history',
 				 	
 				 		'oktech_get_module_grades',
 				 	
 				 		'oktech_get_my_assignment_grade',
 				 	
 				 		'oktech_get_my_cohorts',
 				 	
 				 		'oktech_get_my_courses',
 				 	
 				 		'oktech_get_my_courses_byidnumber',
 				 	
 				 		'oktech_get_my_courses_byusername',
 				 	
 				 		'oktech_get_my_group',
 				 	
 				 		'oktech_get_my_groups',
 				 	
 				 		'oktech_get_my_id',
 				 	
 				 		'oktech_get_my_module_grade',
 				 	
 				 		'oktech_get_my_quiz_grade',
 				 	
 				 		'oktech_get_primaryrole_incourse',
 				 	
 				 		'oktech_get_quiz',
 				 	
 				 		'oktech_get_resourcefile_byid',
 				 	
 				 		'oktech_get_resources',
 				 	
 				 		'oktech_get_role_byid',
 				 	
 				 		'oktech_get_role_byname',
 				 	
 				 		'oktech_get_roles',
 				 	
 				 		'oktech_get_sections',
 				 	
 				 		'oktech_get_string_array',
 				 	
 				 		'oktech_get_students',
 				 	
 				 		'oktech_get_teachers',
 				 	
 				 		'oktech_get_user',
 				 	
 				 		'oktech_get_user_byid',
 				 	
 				 		'oktech_get_user_byidnumber',
 				 	
 				 		'oktech_get_user_byusername',
 				 	
 				 		'oktech_get_user_grades',
 				 	
 				 		'oktech_get_users',
 				 	
 				 		'oktech_get_users_bycourse',
 				 	
 				 		'oktech_get_users_byprofile',
 				 	
 				 		'oktech_get_version',
 				 	
 				 		'oktech_has_role_incourse',
 				 	
 				 		'oktech_message_send',
 				 	
 				 		'oktech_remove_group_from_grouping',
 				 	
 				 		'oktech_remove_noneditingteacher',
 				 	
 				 		'oktech_remove_student',
 				 	
 				 		'oktech_remove_teacher',
 				 	
 				 		'oktech_remove_user_from_cohort',
 				 	
 				 		'oktech_remove_user_from_course',
 				 	
 				 		'oktech_remove_user_from_group',
 				 	
 				 		'oktech_remove_users_from_cohort',
 				 	
 				 		'oktech_remove_users_from_group',
 				 	
 				 		'oktech_set_user_profile_values',
 				 	
 				 		'oktech_unenrol_students',
 				 	
 				 		'oktech_update_cohort',
 				 	
 				 		'oktech_update_course',
 				 	
 				 		'oktech_update_group',
 				 	
 				 		'oktech_update_grouping',
 				 	
 				 		'oktech_update_section',
 				 	
 				 		'oktech_update_user',
 				 	
                ),
                'enabled'=>1,
                'component'=>'oktech',
                'restrictedusers'=>0,
        ),
);




?>
