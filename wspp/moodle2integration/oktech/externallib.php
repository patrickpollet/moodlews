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
// along with Moodle.  If not, see http://www.gnu.org/licenses.

/**
 * External course participation api.
 *
 * This api is mostly read only, the actual enrol and unenrol
 * support is in each enrol plugin.
 *
 * @package    oktech
 * @copyright  2011 Patrick Pollet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");
require_once("oktech_classeslib.php");
require_once("$CFG->dirroot/wspp/mdl_m2server.class.php");



class oktech_external extends external_api {



    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_assignment_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_assignmentDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param assignmentDatum $datum
     * @return assignmentRecord[]
     */
    public static function add_assignment($datum) {
    	$server = new mdl_m2server();
    	return $server->add_assignment(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_assignment_returns() {
    	return new oktech_add_assignmentResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_category_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_categoryDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param categoryDatum $datum
     * @return categoryRecord[]
     */
    public static function add_category($datum) {
    	$server = new mdl_m2server();
    	return $server->add_category(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_category_returns() {
    	return new oktech_add_categoryResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_cohort_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_cohortDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param cohortDatum $datum
     * @return cohortRecord[]
     */
    public static function add_cohort($datum) {
    	$server = new mdl_m2server();
    	return $server->add_cohort(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_cohort_returns() {
    	return new oktech_add_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_course_parameters() {
    	$content=array(
    	  
	      'coursedatum'	=>new oktech_courseDatum(' (at leat shortname, name, idnumber )',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 add a single course to Moodle

    * @param int $client
    * @param string $sesskey
    * @param courseDatum $coursedatum  (at leat shortname, name, idnumber )
    * @return courseRecord[]  a completed course record inserted in DB or error record
    */
    public static function add_course($coursedatum) {
    	$server = new mdl_m2server();
    	return $server->add_course(0,'',
    	$coursedatum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_course_returns() {
    	return new oktech_add_courseResponse(' a completed course record inserted in DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_database_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_databaseDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param databaseDatum $datum
     * @return databaseRecord[]
     */
    public static function add_database($datum) {
    	$server = new mdl_m2server();
    	return $server->add_database(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_database_returns() {
    	return new oktech_add_databaseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_forum_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_forumDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param forumDatum $datum
     * @return forumRecord[]
     */
    public static function add_forum($datum) {
    	$server = new mdl_m2server();
    	return $server->add_forum(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_forum_returns() {
    	return new oktech_add_forumResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_group_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_groupDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param groupDatum $datum
     * @return groupRecord[]
     */
    public static function add_group($datum) {
    	$server = new mdl_m2server();
    	return $server->add_group(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_group_returns() {
    	return new oktech_add_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_grouping_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_groupingDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param groupingDatum $datum
     * @return groupingRecord[]
     */
    public static function add_grouping($datum) {
    	$server = new mdl_m2server();
    	return $server->add_grouping(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_grouping_returns() {
    	return new oktech_add_groupingResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_label_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_labelDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param labelDatum $datum
     * @return labelRecord[]
     */
    public static function add_label($datum) {
    	$server = new mdl_m2server();
    	return $server->add_label(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_label_returns() {
    	return new oktech_add_labelResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_noneditingteacher_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * add a non editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function add_noneditingteacher($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->add_noneditingteacher(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_noneditingteacher_returns() {
    	return new oktech_add_noneditingteacherResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_pagewiki_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_pageWikiDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param pageWikiDatum $datum
     * @return pageWikiRecord[]
     */
    public static function add_pagewiki($datum) {
    	$server = new mdl_m2server();
    	return $server->add_pagewiki(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_pagewiki_returns() {
    	return new oktech_add_pagewikiResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_section_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_sectionDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param sectionDatum $datum
     * @return sectionRecord[]
     */
    public static function add_section($datum) {
    	$server = new mdl_m2server();
    	return $server->add_section(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_section_returns() {
    	return new oktech_add_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_student_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * add a student role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function add_student($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->add_student(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_student_returns() {
    	return new oktech_add_studentResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_teacher_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * add a editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function add_teacher($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->add_teacher(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_teacher_returns() {
    	return new oktech_add_teacherResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_user_parameters() {
    	$content=array(
    	  
	      'userdatum'	=>new oktech_userDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * @param int $client
    * @param string $sesskey
    * @param userDatum $userdatum
    * @return userRecord[]
    */
    public static function add_user($userdatum) {
    	$server = new mdl_m2server();
    	return $server->add_user(0,'',
    	$userdatum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_user_returns() {
    	return new oktech_add_userResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function add_wiki_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_wikiDatum('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param wikiDatum $datum
     * @return wikiRecord[]
     */
    public static function add_wiki($datum) {
    	$server = new mdl_m2server();
    	return $server->add_wiki(0,'',
    	$datum);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  add_wiki_returns() {
    	return new oktech_add_wikiResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_assignment_to_section_parameters() {
    	$content=array(
    	  
	      'assignmentid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupmode'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $assignmentid
     * @param int $sectionid
     * @param int $groupmode
     * @return affectRecord
     */
    public static function affect_assignment_to_section($assignmentid,$sectionid,$groupmode) {
    	$server = new mdl_m2server();
    	return $server->affect_assignment_to_section(0,'',
    	$assignmentid,
    	$sectionid,
    	$groupmode);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_assignment_to_section_returns() {
    	return new oktech_affect_assignment_to_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_course_to_category_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'categoryid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $courseid
     * @param int $categoryid
     * @return affectRecord
     */
    public static function affect_course_to_category($courseid,$categoryid) {
    	$server = new mdl_m2server();
    	return $server->affect_course_to_category(0,'',
    	$courseid,
    	$categoryid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_course_to_category_returns() {
    	return new oktech_affect_course_to_categoryResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_database_to_section_parameters() {
    	$content=array(
    	  
	      'databaseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $databaseid
     * @param int $sectionid
     * @return affectRecord
     */
    public static function affect_database_to_section($databaseid,$sectionid) {
    	$server = new mdl_m2server();
    	return $server->affect_database_to_section(0,'',
    	$databaseid,
    	$sectionid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_database_to_section_returns() {
    	return new oktech_affect_database_to_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_forum_to_section_parameters() {
    	$content=array(
    	  
	      'forumid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupmode'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $forumid
     * @param int $sectionid
     * @param int $groupmode
     * @return affectRecord
     */
    public static function affect_forum_to_section($forumid,$sectionid,$groupmode) {
    	$server = new mdl_m2server();
    	return $server->affect_forum_to_section(0,'',
    	$forumid,
    	$sectionid,
    	$groupmode);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_forum_to_section_returns() {
    	return new oktech_affect_forum_to_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_group_to_course_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $courseid
     * @return affectRecord
     */
    public static function affect_group_to_course($groupid,$courseid) {
    	$server = new mdl_m2server();
    	return $server->affect_group_to_course(0,'',
    	$groupid,
    	$courseid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_group_to_course_returns() {
    	return new oktech_affect_group_to_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_group_to_grouping_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupingid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $groupingid
     * @return affectRecord
     */
    public static function affect_group_to_grouping($groupid,$groupingid) {
    	$server = new mdl_m2server();
    	return $server->affect_group_to_grouping(0,'',
    	$groupid,
    	$groupingid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_group_to_grouping_returns() {
    	return new oktech_affect_group_to_groupingResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_grouping_to_course_parameters() {
    	$content=array(
    	  
	      'groupingid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupingid
     * @param int $courseid
     * @return affectRecord
     */
    public static function affect_grouping_to_course($groupingid,$courseid) {
    	$server = new mdl_m2server();
    	return $server->affect_grouping_to_course(0,'',
    	$groupingid,
    	$courseid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_grouping_to_course_returns() {
    	return new oktech_affect_grouping_to_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_label_to_section_parameters() {
    	$content=array(
    	  
	      'labelid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $labelid
     * @param int $sectionid
     * @return affectRecord
     */
    public static function affect_label_to_section($labelid,$sectionid) {
    	$server = new mdl_m2server();
    	return $server->affect_label_to_section(0,'',
    	$labelid,
    	$sectionid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_label_to_section_returns() {
    	return new oktech_affect_label_to_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_pageWiki_to_wiki_parameters() {
    	$content=array(
    	  
	      'pageid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'wikiid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $pageid
     * @param int $wikiid
     * @return affectRecord
     */
    public static function affect_pageWiki_to_wiki($pageid,$wikiid) {
    	$server = new mdl_m2server();
    	return $server->affect_pageWiki_to_wiki(0,'',
    	$pageid,
    	$wikiid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_pageWiki_to_wiki_returns() {
    	return new oktech_affect_pageWiki_to_wikiResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_section_to_course_parameters() {
    	$content=array(
    	  
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $sectionid
     * @param int $courseid
     * @return affectRecord
     */
    public static function affect_section_to_course($sectionid,$courseid) {
    	$server = new mdl_m2server();
    	return $server->affect_section_to_course(0,'',
    	$sectionid,
    	$courseid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_section_to_course_returns() {
    	return new oktech_affect_section_to_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_user_to_cohort_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    public static function affect_user_to_cohort($userid,$groupid) {
    	$server = new mdl_m2server();
    	return $server->affect_user_to_cohort(0,'',
    	$userid,
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_user_to_cohort_returns() {
    	return new oktech_affect_user_to_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_user_to_course_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'rolename'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * @param int $client
    * @param string $sesskey
    * @param int $userid
    * @param int $courseid
    * @param string $rolename
    * @return affectRecord
    */
    public static function affect_user_to_course($userid,$courseid,$rolename) {
    	$server = new mdl_m2server();
    	return $server->affect_user_to_course(0,'',
    	$userid,
    	$courseid,
    	$rolename);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_user_to_course_returns() {
    	return new oktech_affect_user_to_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_user_to_group_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    public static function affect_user_to_group($userid,$groupid) {
    	$server = new mdl_m2server();
    	return $server->affect_user_to_group(0,'',
    	$userid,
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_user_to_group_returns() {
    	return new oktech_affect_user_to_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_users_to_cohort_parameters() {
    	$content=array(
    	  
	      'userids'	=>new oktech_stringArray('',VALUE_REQUIRED,false),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'cohortid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'cohortidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * add users to a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public static function affect_users_to_cohort($userids,$useridfield,$cohortid,$cohortidfield) {
    	$server = new mdl_m2server();
    	return $server->affect_users_to_cohort(0,'',
    	$userids,
    	$useridfield,
    	$cohortid,
    	$cohortidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_users_to_cohort_returns() {
    	return new oktech_affect_users_to_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_users_to_group_parameters() {
    	$content=array(
    	  
	      'userids'	=>new oktech_stringArray('',VALUE_REQUIRED,false),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'groupid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'groupidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * add users to a group
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $groupid
     * @param string $groupidfield
     * @return enrolRecord[]
     */
    public static function affect_users_to_group($userids,$useridfield,$groupid,$groupidfield) {
    	$server = new mdl_m2server();
    	return $server->affect_users_to_group(0,'',
    	$userids,
    	$useridfield,
    	$groupid,
    	$groupidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_users_to_group_returns() {
    	return new oktech_affect_users_to_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function affect_wiki_to_section_parameters() {
    	$content=array(
    	  
	      'wikiid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'sectionid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupmode'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'visible'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $wikiid
     * @param int $sectionid
     * @param int $groupmode
     * @param int $visible
     * @return affectRecord
     */
    public static function affect_wiki_to_section($wikiid,$sectionid,$groupmode,$visible) {
    	$server = new mdl_m2server();
    	return $server->affect_wiki_to_section(0,'',
    	$wikiid,
    	$sectionid,
    	$groupmode,
    	$visible);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  affect_wiki_to_section_returns() {
    	return new oktech_affect_wiki_to_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function count_activities_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,''),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'limit'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,0),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $courseid
     * @param string $courseidfield
     * @param int $limit
     * @return int
     */
    public static function count_activities($userid,$useridfield,$courseid,$courseidfield,$limit) {
    	$server = new mdl_m2server();
    	return $server->count_activities(0,'',
    	$userid,
    	$useridfield,
    	$courseid,
    	$courseidfield,
    	$limit);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  count_activities_returns() {
    	return new oktech_count_activitiesResponse(PARAM_INT,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function count_users_bycourse_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'roleid'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,0),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return the count of  users having role $idrole in course $idcourse identified by $idfield
    * Role id number in mdl_roles table. If empty, all roles are matched
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @param int $roleid
    * @return int
    */
    public static function count_users_bycourse($courseid,$idfield,$roleid) {
    	$server = new mdl_m2server();
    	return $server->count_users_bycourse(0,'',
    	$courseid,
    	$idfield,
    	$roleid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  count_users_bycourse_returns() {
    	return new oktech_count_users_bycourseResponse(PARAM_INT,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_cohort_parameters() {
    	$content=array(
    	  
	      'id'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
      * rev 1.6 delete a single cohort from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return cohortRecord[] a completed cohort record juste deleted from DB or error record
      */
    public static function delete_cohort($id,$idfield) {
    	$server = new mdl_m2server();
    	return $server->delete_cohort(0,'',
    	$id,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  delete_cohort_returns() {
    	return new oktech_delete_cohortResponse('a completed cohort record juste deleted from DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_course_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * rev 1.6 delete a single course from Moodle
      * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @return courseRecord[] a completed course record juste deleted from DB or error record
     */
    public static function delete_course($courseid,$courseidfield) {
    	$server = new mdl_m2server();
    	return $server->delete_course(0,'',
    	$courseid,
    	$courseidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  delete_course_returns() {
    	return new oktech_delete_courseResponse('a completed course record juste deleted from DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_group_parameters() {
    	$content=array(
    	  
	      'id'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
      * rev 1.6 delete a single group from Moodle
      * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return groupRecord[] a completed group record juste deleted from DB or error record
      */
    public static function delete_group($id,$idfield) {
    	$server = new mdl_m2server();
    	return $server->delete_group(0,'',
    	$id,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  delete_group_returns() {
    	return new oktech_delete_groupResponse('a completed group record juste deleted from DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_grouping_parameters() {
    	$content=array(
    	  
	      'id'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
      * rev 1.6 delete a single group from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return groupingRecord[] a completed grouping record juste deleted from DB or error record
      */
    public static function delete_grouping($id,$idfield) {
    	$server = new mdl_m2server();
    	return $server->delete_grouping(0,'',
    	$id,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  delete_grouping_returns() {
    	return new oktech_delete_groupingResponse('a completed grouping record juste deleted from DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_user_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
      * rev 1.6 delete a single group from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $userid
      * @param string $useridfield
      * @return userRecord[] a completed user record juste deleted from DB or error record
      */
    public static function delete_user($userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->delete_user(0,'',
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  delete_user_returns() {
    	return new oktech_delete_userResponse('a completed user record juste deleted from DB or error record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_assignments_parameters() {
    	$content=array(
    	  
	      'assignments'	=>new oktech_assignmentDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param assignmentDatum[] $assignments
      * @return assignmentRecord[]
      */
    public static function edit_assignments($assignments) {
    	$server = new mdl_m2server();
    	return $server->edit_assignments(0,'',
    	$assignments);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_assignments_returns() {
    	return new oktech_edit_assignmentsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_categories_parameters() {
    	$content=array(
    	  
	      'categories'	=>new oktech_categoryDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param categoryDatum[] $categories
      * @return categoryRecord[]
      */
    public static function edit_categories($categories) {
    	$server = new mdl_m2server();
    	return $server->edit_categories(0,'',
    	$categories);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_categories_returns() {
    	return new oktech_edit_categoriesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_courses_parameters() {
    	$content=array(
    	  
	      'courses'	=>new oktech_courseDatumArray('An array of course records (objects or arrays) for',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find Edit course records (add/update/delete).
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param courseDatum[] $courses An array of course records (objects or arrays) for
     *                         editing (including operation to perform).
     * @return courseRecord[] An array of course records.
     */
    public static function edit_courses($courses) {
    	$server = new mdl_m2server();
    	return $server->edit_courses(0,'',
    	$courses);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_courses_returns() {
    	return new oktech_edit_coursesResponse('An array of course records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_databases_parameters() {
    	$content=array(
    	  
	      'databases'	=>new oktech_databaseDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param databaseDatum[] $databases
      * @return databaseRecord[]
      */
    public static function edit_databases($databases) {
    	$server = new mdl_m2server();
    	return $server->edit_databases(0,'',
    	$databases);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_databases_returns() {
    	return new oktech_edit_databasesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_forums_parameters() {
    	$content=array(
    	  
	      'forums'	=>new oktech_forumDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param forumDatum[] $forums
      * @return forumRecord[]
      */
    public static function edit_forums($forums) {
    	$server = new mdl_m2server();
    	return $server->edit_forums(0,'',
    	$forums);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_forums_returns() {
    	return new oktech_edit_forumsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_groupings_parameters() {
    	$content=array(
    	  
	      'groupings'	=>new oktech_groupingDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param groupingDatum[] $groupings
      * @return groupingRecord[]
      */
    public static function edit_groupings($groupings) {
    	$server = new mdl_m2server();
    	return $server->edit_groupings(0,'',
    	$groupings);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_groupings_returns() {
    	return new oktech_edit_groupingsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_groups_parameters() {
    	$content=array(
    	  
	      'groups'	=>new oktech_groupDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param groupDatum[] $groups
      * @return groupRecord[]
      */
    public static function edit_groups($groups) {
    	$server = new mdl_m2server();
    	return $server->edit_groups(0,'',
    	$groups);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_groups_returns() {
    	return new oktech_edit_groupsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_labels_parameters() {
    	$content=array(
    	  
	      'labels'	=>new oktech_labelDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param labelDatum[] $labels
      * @return labelRecord[]
      */
    public static function edit_labels($labels) {
    	$server = new mdl_m2server();
    	return $server->edit_labels(0,'',
    	$labels);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_labels_returns() {
    	return new oktech_edit_labelsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_pagesWiki_parameters() {
    	$content=array(
    	  
	      'pageswiki'	=>new oktech_pageWikiDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param pageWikiDatum[] $pageswiki
      * @return pageWikiRecord[]
      */
    public static function edit_pagesWiki($pageswiki) {
    	$server = new mdl_m2server();
    	return $server->edit_pagesWiki(0,'',
    	$pageswiki);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_pagesWiki_returns() {
    	return new oktech_edit_pagesWikiResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_sections_parameters() {
    	$content=array(
    	  
	      'sections'	=>new oktech_sectionDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param sectionDatum[] $sections
      * @return sectionRecord[]
      */
    public static function edit_sections($sections) {
    	$server = new mdl_m2server();
    	return $server->edit_sections(0,'',
    	$sections);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_sections_returns() {
    	return new oktech_edit_sectionsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_users_parameters() {
    	$content=array(
    	  
	      'users'	=>new oktech_userDatumArray('An array of user records (objects or arrays) for editin   (including opertaion to perform).',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Edit user records (add/update/delete).
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param userDatum[] $users An array of user records (objects or arrays) for editin   (including opertaion to perform).
     * @return userRecord[] An array of user objects.
     */
    public static function edit_users($users) {
    	$server = new mdl_m2server();
    	return $server->edit_users(0,'',
    	$users);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_users_returns() {
    	return new oktech_edit_usersResponse('An array of user objects.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function edit_wikis_parameters() {
    	$content=array(
    	  
	      'wikis'	=>new oktech_wikiDatumArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * @param int $client
      * @param string $sesskey
      * @param wikiDatum[] $wikis
      * @return wikiRecord[]
      */
    public static function edit_wikis($wikis) {
    	$server = new mdl_m2server();
    	return $server->edit_wikis(0,'',
    	$wikis);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  edit_wikis_returns() {
    	return new oktech_edit_wikisResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function enrol_students_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'The course ID number to enrol students',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'The field used to identify course (idnumber,id,shortname...)',VALUE_REQUIRED,'false'),
	      'userids'	=>new oktech_stringArray('An array of input user idnumber values for enrolment.',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,'student identifier, default idnumber',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Enrol users as a student in the given course.
     * prerequisite : corresponding students records MUST exist in Moodle
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $courseid The course ID number to enrol students
     * @param string $courseidfield The field used to identify course (idnumber,id,shortname...)
     * @param string[] $userids An array of input user idnumber values for enrolment.
     * @param string $idfield student identifier, default idnumber
     * @return enrolRecord[] Return data (user_student records) to be converted into a
     *               specific data format for sending to the client.
     */
    public static function enrol_students($courseid,$courseidfield,$userids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->enrol_students(0,'',
    	$courseid,
    	$courseidfield,
    	$userids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  enrol_students_returns() {
    	return new oktech_enrol_studentsResponse('Return data (user_student records) to be converted into a',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_activities_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'0'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'limit'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,99),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * return all logged actions of user in one course or any course
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $courseid
     * @param string $courseidfield
     * @param int $limit
     * @return activityRecord[]
     */
    public static function get_activities($userid,$useridfield,$courseid,$courseidfield,$limit) {
    	$server = new mdl_m2server();
    	return $server->get_activities(0,'',
    	$userid,
    	$useridfield,
    	$courseid,
    	$courseidfield,
    	$limit);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_activities_returns() {
    	return new oktech_get_activitiesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_assignments_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return assignmentRecord[]
     */
    public static function get_all_assignments($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_assignments(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_assignments_returns() {
    	return new oktech_get_all_assignmentsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_cohorts_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return cohortRecord[]
     */
    public static function get_all_cohorts($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_cohorts(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_cohorts_returns() {
    	return new oktech_get_all_cohortsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_databases_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return databaseRecord[]
     */
    public static function get_all_databases($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_databases(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_databases_returns() {
    	return new oktech_get_all_databasesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_forums_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return forumRecord[]
     */
    public static function get_all_forums($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_forums(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_forums_returns() {
    	return new oktech_get_all_forumsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_groupings_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return groupingRecord[]
     */
    public static function get_all_groupings($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_groupings(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_groupings_returns() {
    	return new oktech_get_all_groupingsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_groups_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return groupRecord[]
     */
    public static function get_all_groups($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_groups(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_groups_returns() {
    	return new oktech_get_all_groupsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_labels_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return labelRecord[]
     */
    public static function get_all_labels($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_labels(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_labels_returns() {
    	return new oktech_get_all_labelsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_pagesWiki_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return pageWikiRecord[]
     */
    public static function get_all_pagesWiki($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_pagesWiki(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_pagesWiki_returns() {
    	return new oktech_get_all_pagesWikiResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_quizzes_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return quizRecord[]
     */
    public static function get_all_quizzes($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_quizzes(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_quizzes_returns() {
    	return new oktech_get_all_quizzesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_all_wikis_parameters() {
    	$content=array(
    	  
	      'fieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'fieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return wikiRecord[]
     */
    public static function get_all_wikis($fieldname,$fieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_all_wikis(0,'',
    	$fieldname,
    	$fieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_all_wikis_returns() {
    	return new oktech_get_all_wikisResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_assignment_submissions_parameters() {
    	$content=array(
    	  
	      'assignmentid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'userids'	=>new oktech_stringArray('',VALUE_DEFAULT,array()),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'timemodified'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,0),
	      'zipfiles'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,1),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $assignmentid
     * @param string[] $userids
     * @param string $useridfield
     * @param int $timemodified
     * @param int $zipfiles
     * @return assignmentSubmissionRecord[]
     */
    public static function get_assignment_submissions($assignmentid,$userids,$useridfield,$timemodified,$zipfiles) {
    	$server = new mdl_m2server();
    	return $server->get_assignment_submissions(0,'',
    	$assignmentid,
    	$userids,
    	$useridfield,
    	$timemodified,
    	$zipfiles);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_assignment_submissions_returns() {
    	return new oktech_get_assignment_submissionsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_boolean_array_parameters() {
    	$content=array(
    	      	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @return boolean[]
     */
    public static function get_boolean_array() {
    	$server = new mdl_m2server();
    	return $server->get_boolean_array();
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_boolean_array_returns() {
    	return new oktech_get_boolean_arrayResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_categories_parameters() {
    	$content=array(
    	  
	      'catid'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,''),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,''),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return categories  identified by
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $catid
    * @param string $idfield
    * @return categoryRecord[]
    */
    public static function get_categories($catid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_categories(0,'',
    	$catid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_categories_returns() {
    	return new oktech_get_categoriesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_category_byid_parameters() {
    	$content=array(
    	  
	      'catid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return categories Record identified by id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $catid
    * @return categoryRecord[]
    */
    public static function get_category_byid($catid) {
    	$server = new mdl_m2server();
    	return $server->get_category_byid(0,'',
    	$catid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_category_byid_returns() {
    	return new oktech_get_category_byidResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_category_byname_parameters() {
    	$content=array(
    	  
	      'catname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * return categories Record identified by name
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $catname
     * @return categoryRecord[]
     */
    public static function get_category_byname($catname) {
    	$server = new mdl_m2server();
    	return $server->get_category_byname(0,'',
    	$catname);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_category_byname_returns() {
    	return new oktech_get_category_bynameResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_cohort_byid_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,' the cohort\'s Moodle identifier',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the cohort's Moodle identifier
    * @return cohortRecord[]  Array of cohortRecord
    */
    public static function get_cohort_byid($groupid) {
    	$server = new mdl_m2server();
    	return $server->get_cohort_byid(0,'',
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_cohort_byid_returns() {
    	return new oktech_get_cohort_byidResponse(' Array of cohortRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_cohort_byidnumber_parameters() {
    	$content=array(
    	  
	      'cohortidnumber'	=>new external_value(PARAM_CLEAN,' the cohort\'s Moodle identifier',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $cohortidnumber  the cohort's Moodle identifier
    * @return cohortRecord[]
    */
    public static function get_cohort_byidnumber($cohortidnumber) {
    	$server = new mdl_m2server();
    	return $server->get_cohort_byidnumber(0,'',
    	$cohortidnumber);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_cohort_byidnumber_returns() {
    	return new oktech_get_cohort_byidnumberResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_cohort_members_parameters() {
    	$content=array(
    	  
	      'id'	=>new external_value(PARAM_CLEAN,' the group\'s Moodle identifier',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'the filed used to identity the group',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return members of cohort identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $id  the group's Moodle identifier
    * @param string $idfield the filed used to identity the group
    * @return userRecord[]  Array of user Record
    */
    public static function get_cohort_members($id,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_cohort_members(0,'',
    	$id,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_cohort_members_returns() {
    	return new oktech_get_cohort_membersResponse(' Array of user Record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_cohorts_byname_parameters() {
    	$content=array(
    	  
	      'cohortname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $cohortname
    * @return cohortRecord[]  Array of cohortRecord
    */
    public static function get_cohorts_byname($cohortname) {
    	$server = new mdl_m2server();
    	return $server->get_cohorts_byname(0,'',
    	$cohortname);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_cohorts_byname_returns() {
    	return new oktech_get_cohorts_bynameResponse(' Array of cohortRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_course_parameters() {
    	$content=array(
    	  
	      'info'	=>new external_value(PARAM_CLEAN,' Moodle\'s  course id to search',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,' filed used to find the course',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return an array of course record having $idfield=$info
    * can be used for any criteria
    *   eg: in python proxy.get_courses(a,b,'visible',0)
    *   note that is that case, only admins and courses teachers will get them
    * @see server.soap.class filter_course
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course id to search
    * @param string $idfield  filed used to find the course
    * @return courseRecord[]
    */
    public static function get_course($info,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_course(0,'',
    	$info,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_course_returns() {
    	return new oktech_get_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_course_byid_parameters() {
    	$content=array(
    	  
	      'info'	=>new external_value(PARAM_CLEAN,' Moodle\'s  course id',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return courseRecord for one course identified by Moodle's id $info
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course id
    * @return courseRecord[]
    */
    public static function get_course_byid($info) {
    	$server = new mdl_m2server();
    	return $server->get_course_byid(0,'',
    	$info);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_course_byid_returns() {
    	return new oktech_get_course_byidResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_course_byidnumber_parameters() {
    	$content=array(
    	  
	      'info'	=>new external_value(PARAM_CLEAN,' Moodle\'s  course idnumber',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return courseRecord for one course identified by Moodle's idnumber $info
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course idnumber
    * @return courseRecord[]
    */
    public static function get_course_byidnumber($info) {
    	$server = new mdl_m2server();
    	return $server->get_course_byidnumber(0,'',
    	$info);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_course_byidnumber_returns() {
    	return new oktech_get_course_byidnumberResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_course_grades_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'course id number',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'field used to identity the course',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find and return course grades for currently enrolled students  (moodle 1.9)
     *
     * @uses $CFG
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $courseid course id number
     * @param string $idfield field used to identity the course
     * @return gradeRecord[] student grades
     */
    public static function get_course_grades($courseid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_course_grades(0,'',
    	$courseid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_course_grades_returns() {
    	return new oktech_get_course_gradesResponse('student grades',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_courses_parameters() {
    	$content=array(
    	  
	      'courseids'	=>new oktech_stringArray('An array of input course id values to search for. If empty return all courses',VALUE_DEFAULT,array()),
	      'idfield'	=>new external_value(PARAM_CLEAN,': the field used to identify courses',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find and return a list of course records.
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string[] $courseids An array of input course id values to search for. If empty return all courses
     * @param string $idfield : the field used to identify courses
     * @return courseRecord[] An array of resource records.
     */
    public static function get_courses($courseids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_courses(0,'',
    	$courseids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_courses_returns() {
    	return new oktech_get_coursesResponse('An array of resource records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_courses_bycategory_parameters() {
    	$content=array(
    	  
	      'catid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * return courses if category identified by id
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $catid
     * @return courseRecord[]
     */
    public static function get_courses_bycategory($catid) {
    	$server = new mdl_m2server();
    	return $server->get_courses_bycategory(0,'',
    	$catid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_courses_bycategory_returns() {
    	return new oktech_get_courses_bycategoryResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_courses_search_parameters() {
    	$content=array(
    	  
	      'search'	=>new external_value(PARAM_CLEAN,'A string of criteria to search eventually separated by space if empty return all course',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * rev 1.6.2
     * find and return a list of courses having $search in their name, fullname or description
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $search A string of criteria to search eventually separated by space if empty return all course
     * @return courseRecord[] An array of resource records.
     */
    public static function get_courses_search($search) {
    	$server = new mdl_m2server();
    	return $server->get_courses_search(0,'',
    	$search);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_courses_search_returns() {
    	return new oktech_get_courses_searchResponse('An array of resource records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_events_parameters() {
    	$content=array(
    	  
	      'eventtype'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'ownerid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'owneridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'id'),
	      'datetimefrom'	=>new external_value(PARAM_INT,' -1 all events  0 now () another timestamp =events starting after and egal to that one',VALUE_DEFAULT,-1),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $eventtype
     * @param string $ownerid
     * @param string $owneridfield
     * @param int $datetimefrom  -1 all events  0 now () another timestamp =events starting after and egal to that one
     * @return eventRecord[]
     */
    public static function get_events($eventtype,$ownerid,$owneridfield,$datetimefrom) {
    	$server = new mdl_m2server();
    	return $server->get_events(0,'',
    	$eventtype,
    	$ownerid,
    	$owneridfield,
    	$datetimefrom);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_events_returns() {
    	return new oktech_get_eventsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_float_array_parameters() {
    	$content=array(
    	  
	      'n'	=>new external_value(PARAM_NUMBER,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param float n
     * @return float[]
     */
    public static function get_float_array($n) {
    	$server = new mdl_m2server();
    	return $server->get_float_array(
    	$n);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_float_array_returns() {
    	return new oktech_get_float_arrayResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_grades_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'The Student ID of the student.',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'the field used to identity student',VALUE_REQUIRED,'false'),
	      'courseids'	=>new oktech_stringArray('Array of course ids , if empty all grades',VALUE_REQUIRED,false),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'field used to identity the courses',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find and return student grades for specified courses  (moodle 1.9)
     * NOTE Courses MUST have an id_number
     * @uses $CFG
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userid The Student ID of the student.
     * @param string $useridfield the field used to identity student
     * @param string[] $courseids Array of course ids , if empty all grades
     * @param string $courseidfield field used to identity the courses
     * @return gradeRecord[] student grades
     *
     */
    public static function get_grades($userid,$useridfield,$courseids,$courseidfield) {
    	$server = new mdl_m2server();
    	return $server->get_grades(0,'',
    	$userid,
    	$useridfield,
    	$courseids,
    	$courseidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_grades_returns() {
    	return new oktech_get_gradesResponse('student grades',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_group_byid_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,' the group\'s Moodle identifier',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the group's Moodle identifier
    * @return groupRecord[]  Array of groupRecord
    */
    public static function get_group_byid($groupid) {
    	$server = new mdl_m2server();
    	return $server->get_group_byid(0,'',
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_group_byid_returns() {
    	return new oktech_get_group_byidResponse(' Array of groupRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_group_members_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_CLEAN,' the group\'s Moodle identifier',VALUE_REQUIRED,'false'),
	      'groupidfield'	=>new external_value(PARAM_CLEAN,'the filed used to identity the group',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return members of group identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupid  the group's Moodle identifier
    * @param string $groupidfield the filed used to identity the group
    * @return userRecord[]  Array of user Record
    */
    public static function get_group_members($groupid,$groupidfield) {
    	$server = new mdl_m2server();
    	return $server->get_group_members(0,'',
    	$groupid,
    	$groupidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_group_members_returns() {
    	return new oktech_get_group_membersResponse(' Array of user Record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_grouping_byid_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,' the group\'s Moodle identifier',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the group's Moodle identifier
    * @return groupRecord[]  Array of groupRecord
    */
    public static function get_grouping_byid($groupid) {
    	$server = new mdl_m2server();
    	return $server->get_grouping_byid(0,'',
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_grouping_byid_returns() {
    	return new oktech_get_grouping_byidResponse(' Array of groupRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_grouping_members_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_CLEAN,' the grouping\'s Moodle identifier',VALUE_REQUIRED,'false'),
	      'groupidfield'	=>new external_value(PARAM_CLEAN,'the filed used to identity the grouping',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return members of grouping identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupid  the grouping's Moodle identifier
    * @param string $groupidfield the filed used to identity the grouping
    * @return userRecord[]  Array of user Record
    */
    public static function get_grouping_members($groupid,$groupidfield) {
    	$server = new mdl_m2server();
    	return $server->get_grouping_members(0,'',
    	$groupid,
    	$groupidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_grouping_members_returns() {
    	return new oktech_get_grouping_membersResponse(' Array of user Record',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_groupings_bycourse_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'the course identifier',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,' the course identifier field, defaut = idnumber',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return the list of groupings of course identified by courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid the course identifier
    * @param string $idfield  the course identifier field, defaut = idnumber
    * @return groupingRecord[]
    */
    public static function get_groupings_bycourse($courseid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_groupings_bycourse(0,'',
    	$courseid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_groupings_bycourse_returns() {
    	return new oktech_get_groupings_bycourseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_groupings_byname_parameters() {
    	$content=array(
    	  
	      'groupname'	=>new external_value(PARAM_CLEAN,' the group\'s Moodle name',VALUE_REQUIRED,'false'),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,0),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one or several groupRecord for groups having name $name
    * and (optionally) belonging to course $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupname  the group's Moodle name
    * @param int $courseid
    * @return groupRecord[]  Array of groupRecord
    *
    */
    public static function get_groupings_byname($groupname,$courseid) {
    	$server = new mdl_m2server();
    	return $server->get_groupings_byname(0,'',
    	$groupname,
    	$courseid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_groupings_byname_returns() {
    	return new oktech_get_groupings_bynameResponse(' Array of groupRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_groups_bycourse_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'the course identifier',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,' the course identifier field, defaut = idnumber',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return the list of groups of course identified by courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid the course identifier
    * @param string $idfield  the course identifier field, defaut = idnumber
    * @return groupRecord[]  Array of groupRecord
    */
    public static function get_groups_bycourse($courseid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_groups_bycourse(0,'',
    	$courseid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_groups_bycourse_returns() {
    	return new oktech_get_groups_bycourseResponse(' Array of groupRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_groups_byname_parameters() {
    	$content=array(
    	  
	      'groupname'	=>new external_value(PARAM_CLEAN,' the group\'s Moodle name',VALUE_REQUIRED,'false'),
	      'courseid'	=>new external_value(PARAM_INT,' optional',VALUE_DEFAULT,0),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one or several groupRecord for groups having name $name
    * and (optionally) belonging to course $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupname  the group's Moodle name
    * @param int $courseid  optional
    * @return groupRecord[]  Array of groupRecord
    *
    */
    public static function get_groups_byname($groupname,$courseid) {
    	$server = new mdl_m2server();
    	return $server->get_groups_byname(0,'',
    	$groupname,
    	$courseid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_groups_byname_returns() {
    	return new oktech_get_groups_bynameResponse(' Array of groupRecord',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_instances_bytype_parameters() {
    	$content=array(
    	  
	      'courseids'	=>new oktech_stringArray('An array of input course id values to search for. If empty return all ressources',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,': the field used to identify courses',VALUE_DEFAULT,'idnumber'),
	      'type'	=>new external_value(PARAM_CLEAN,': activity type i.e. forum, wiki, assignment ...',VALUE_DEFAULT,'resource'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Find and return a list of activities within one or several courses.
    * TODO cast returned data to more specific types
    * currently return only a "generic description"
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input course id values to search for. If empty return all ressources
    * @param string $idfield : the field used to identify courses
    * @param string $type : activity type i.e. forum, wiki, assignment ...
    * @return resourceRecord[] An array of records.
    */
    public static function get_instances_bytype($courseids,$idfield,$type) {
    	$server = new mdl_m2server();
    	return $server->get_instances_bytype(0,'',
    	$courseids,
    	$idfield,
    	$type);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_instances_bytype_returns() {
    	return new oktech_get_instances_bytypeResponse('An array of records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_int_array_parameters() {
    	$content=array(
    	  
	      'n'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int n
     * @return int[]
     */
    public static function get_int_array($n) {
    	$server = new mdl_m2server();
    	return $server->get_int_array(
    	$n);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_int_array_returns() {
    	return new oktech_get_int_arrayResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_last_changes_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'limit'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,10),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
      * @param int $client
      * @param string $sesskey
      * @param string $courseid
      * @param string $idfield
      * @param int $limit
      * @return changeRecord[]
      */
    public static function get_last_changes($courseid,$idfield,$limit) {
    	$server = new mdl_m2server();
    	return $server->get_last_changes(0,'',
    	$courseid,
    	$idfield,
    	$limit);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_last_changes_returns() {
    	return new oktech_get_last_changesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_message_contacts_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**  rev 1.8
     * retrieve all contacts of user identified by userid
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @return contactRecord[]
     */
    public static function get_message_contacts($userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->get_message_contacts(0,'',
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_message_contacts_returns() {
    	return new oktech_get_message_contactsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_messages_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**  rev 1.8
     * retrieve all unread user's messages
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @return messageRecord[]
     */
    public static function get_messages($userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->get_messages(0,'',
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_messages_returns() {
    	return new oktech_get_messagesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_messages_history_parameters() {
    	$content=array(
    	  
	      'useridto'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridtofield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfrom'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfromfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**  rev 1.8
     * retrieve all unread user's messages
     * @param int $client
     * @param string $sesskey
     * @param string $useridto
     * @param string $useridtofield
     * @param string $useridfrom
     * @param string $useridfromfield
     * @return messageRecord[]
     */
    public static function get_messages_history($useridto,$useridtofield,$useridfrom,$useridfromfield) {
    	$server = new mdl_m2server();
    	return $server->get_messages_history(0,'',
    	$useridto,
    	$useridtofield,
    	$useridfrom,
    	$useridfromfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_messages_history_returns() {
    	return new oktech_get_messages_historyResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_module_grades_parameters() {
    	$content=array(
    	  
	      'activityid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'activitytype'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userids'	=>new oktech_stringArray('users for with grades are requested (empty = all)',VALUE_DEFAULT,array()),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'name of the field used to identify users id, idnumber,username,email ...',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
	 * retrieve grades to an activity
	 * @param int $client
	 * @param string $sesskey
	 * @param int $activityid
	 * @param string $activitytype
	 * @param string[] $userids users for with grades are requested (empty = all)
	 * @param string $useridfield name of the field used to identify users id, idnumber,username,email ...
	 * @return gradeItemRecord[]
	 */
    public static function get_module_grades($activityid,$activitytype,$userids,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->get_module_grades(0,'',
    	$activityid,
    	$activitytype,
    	$userids,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_module_grades_returns() {
    	return new oktech_get_module_gradesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_assignment_grade_parameters() {
    	$content=array(
    	  
	      'assignmentid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
	 * retrieve my grade to a ass
	 * @param int $client
	 * @param string $sesskey
	 * @param int $assignmentid
	 * @return gradeItemRecord[]
	 */
    public static function get_my_assignment_grade($assignmentid) {
    	$server = new mdl_m2server();
    	return $server->get_my_assignment_grade(0,'',
    	$assignmentid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_assignment_grade_returns() {
    	return new oktech_get_my_assignment_gradeResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_cohorts_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_CLEAN,' Moodle\'s  user to search',VALUE_DEFAULT,''),
	      'idfield'	=>new external_value(PARAM_CLEAN,'field name to search .',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return cohorts to which user $uid belongs to
    * if $uid is empty, use current logged in user.
    * otherwise, current logged in user must be admin to fetch data
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid  Moodle's  user to search
    * @param string $idfield field name to search .
    * @return cohortRecord[]
    *
    */
    public static function get_my_cohorts($uid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_my_cohorts(0,'',
    	$uid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_cohorts_returns() {
    	return new oktech_get_my_cohortsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_courses_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_CLEAN,'(optional) Moodle\'s id of user. If absent, uses current session user id',VALUE_DEFAULT,''),
	      'sort'	=>new external_value(PARAM_CLEAN,'(optional). If absent use parent\'s default (by fullname)',VALUE_DEFAULT,''),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * Find and return a list of courses that a user identified by Moodle's id is a member of.
       *
       * @param int $client The client session ID.
       * @param string $sesskey The client session key.
       * @param string $uid (optional) Moodle's id of user. If absent, uses current session user id
       * @param string $sort (optional). If absent use parent's default (by fullname)
       * @return courseRecord[] Return data (course record) to be converted into a specific
       *               data format for sending to the client.
       */
    public static function get_my_courses($uid,$sort) {
    	$server = new mdl_m2server();
    	return $server->get_my_courses(0,'',
    	$uid,
    	$sort);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_courses_returns() {
    	return new oktech_get_my_coursesResponse('Return data (course record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_courses_byidnumber_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_CLEAN,'(optional) Moodle\'s idnumber of user. If absent, uses current session user id',VALUE_DEFAULT,''),
	      'sort'	=>new external_value(PARAM_CLEAN,'(optional). If absent use parent\'s default (by fullname)',VALUE_DEFAULT,''),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
       * Find and return a list of courses that a user identified by Moodle's idnumber is a member of.
       *
       * @param int $client The client session ID.
       * @param string $sesskey The client session key.
       * @param string $uid (optional) Moodle's idnumber of user. If absent, uses current session user id
       * @param string $sort (optional). If absent use parent's default (by fullname)
       * @return courseRecord[] Return data (course record) to be converted into a specific
       *               data format for sending to the client.
       */
    public static function get_my_courses_byidnumber($uid,$sort) {
    	$server = new mdl_m2server();
    	return $server->get_my_courses_byidnumber(0,'',
    	$uid,
    	$sort);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_courses_byidnumber_returns() {
    	return new oktech_get_my_courses_byidnumberResponse('Return data (course record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_courses_byusername_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_CLEAN,'(optional) Moodle\'s username. If absent, uses current session user id',VALUE_DEFAULT,''),
	      'sort'	=>new external_value(PARAM_CLEAN,'(optional). If absent use parent\'s default (by fullname)',VALUE_DEFAULT,''),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Find and return a list of courses that a user identified by Moodle's username is a member of.
    *
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid (optional) Moodle's username. If absent, uses current session user id
    * @param string $sort (optional). If absent use parent's default (by fullname)
    * @return courseRecord[] Return data (course record) to be converted into a specific
    *               data format for sending to the client.
    */
    public static function get_my_courses_byusername($uid,$sort) {
    	$server = new mdl_m2server();
    	return $server->get_my_courses_byusername(0,'',
    	$uid,
    	$sort);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_courses_byusername_returns() {
    	return new oktech_get_my_courses_byusernameResponse('Return data (course record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_group_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_INT,' Moodle\'s id for user to search',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_INT,' Moodle\'s table column for user to search',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_CLEAN,'course to serach into',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'field used to identify course',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Return user's group(s)  in course identified by $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $uid  Moodle's id for user to search
    * @param int $idfield  Moodle's table column for user to search
    * @param string $courseid course to serach into
    * @param string $courseidfield field used to identify course
    * @return groupRecord[] Return data (array of group  record) to be converted into a specific
    *               data format for sending to the client.
    *
    */
    public static function get_my_group($uid,$idfield,$courseid,$courseidfield) {
    	$server = new mdl_m2server();
    	return $server->get_my_group(0,'',
    	$uid,
    	$idfield,
    	$courseid,
    	$courseidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_group_returns() {
    	return new oktech_get_my_groupResponse('Return data (array of group  record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_groups_parameters() {
    	$content=array(
    	  
	      'uid'	=>new external_value(PARAM_CLEAN,' Moodle\'s  user to search',VALUE_DEFAULT,''),
	      'idfield'	=>new external_value(PARAM_CLEAN,'field name to search .',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return groups to which user $uid belongs to
    * if $uid is empty, use current logged in user.
    * otherwise, current logged in user must be admin to fetch data
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid  Moodle's  user to search
    * @param string $idfield field name to search .
    * @return groupRecord[]
    *
    */
    public static function get_my_groups($uid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_my_groups(0,'',
    	$uid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_groups_returns() {
    	return new oktech_get_my_groupsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_id_parameters() {

    	$content=array(

    	);
         //pp_error_log('appel de get_my_id_parameters',$content);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Return's current user Moodle interanl id
     * a convenience function
     * added here for WSHelper to find it and publish it in the WSDL
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @return int
     */
    public static function get_my_id() {
    	$server = new mdl_m2server();
    	return $server->get_my_id(0,'');
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_id_returns() {
    	return new oktech_get_my_idResponse(PARAM_INT,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_module_grade_parameters() {
    	$content=array(
    	  
	      'activityid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'activitytype'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
	 * retrieve my grade to an activity
	 * @param int $client
	 * @param string $sesskey
	 * @param int $activityid
	 * @param string $activitytype
	 * @return gradeItemRecord[]
	 */
    public static function get_my_module_grade($activityid,$activitytype) {
    	$server = new mdl_m2server();
    	return $server->get_my_module_grade(0,'',
    	$activityid,
    	$activitytype);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_module_grade_returns() {
    	return new oktech_get_my_module_gradeResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_my_quiz_grade_parameters() {
    	$content=array(
    	  
	      'quizid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
	 * retrieve my grade to a quiz
	 * @param int $client
	 * @param string $sesskey
	 * @param int $quizid
	 * @return gradeItemRecord[]
	 */
    public static function get_my_quiz_grade($quizid) {
    	$server = new mdl_m2server();
    	return $server->get_my_quiz_grade(0,'',
    	$quizid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_my_quiz_grade_returns() {
    	return new oktech_get_my_quiz_gradeResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_primaryrole_incourse_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * determine the primary role of user in a course
    * @param int $client The client session record ID.
    * @param string $sesskey The session key returned by a previous login.
    * @param string userid
    * @param string useridfield
    * @param string courseid
    * @param string courseidfield
    * @return int
    *          1 admin
    *          2 coursecreator
    *          3 editing teacher
    *          4 non editing teacher
    *          5 student
    *          6 guest IF course allows guest AND username ==guest
    *          0 nothing
    * since this operation retunr s a simple type, no need to override it in protocol specific layer
    * starting at rev 1.8 it must also be here for parsing by genwslp.php
    */
    public static function get_primaryrole_incourse($userid,$useridfield,$courseid,$courseidfield) {
    	$server = new mdl_m2server();
    	return $server->get_primaryrole_incourse(0,'',
    	$userid,
    	$useridfield,
    	$courseid,
    	$courseidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_primaryrole_incourse_returns() {
    	return new oktech_get_primaryrole_incourseResponse(PARAM_INT,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_quiz_parameters() {
    	$content=array(
    	  
	      'quizid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'format'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'xml'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * rev 1.6.5 added upon request on tstc.edu
     * @param int $client
     * @param string $sesskey
     * @param int $quizid
     * @param string $format
     * @return quizRecord
     */
    public static function get_quiz($quizid,$format) {
    	$server = new mdl_m2server();
    	return $server->get_quiz(0,'',
    	$quizid,
    	$format);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_quiz_returns() {
    	return new oktech_get_quizResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_resourcefile_byid_parameters() {
    	$content=array(
    	  
	      'resourceid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**  rev 1.8.3
     * retrieve a file resource by it's id
     * @param int $client
     * @param string $sesskey
     * @param int $resourceid
     * @return fileRecord
     */
    public static function get_resourcefile_byid($resourceid) {
    	$server = new mdl_m2server();
    	return $server->get_resourcefile_byid(0,'',
    	$resourceid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_resourcefile_byid_returns() {
    	return new oktech_get_resourcefile_byidResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_resources_parameters() {
    	$content=array(
    	  
	      'courseids'	=>new oktech_stringArray('An array of input course id values to search for. If empty return all ressources',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,': the field used to identify courses',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Find and return a list of ressources within one or several courses.
    * OK PP tested with php5 5 and python clients
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input course id values to search for. If empty return all ressources
    * @param string $idfield : the field used to identify courses
    * @return resourceRecord[] An array of resource records.
    */
    public static function get_resources($courseids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_resources(0,'',
    	$courseids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_resources_returns() {
    	return new oktech_get_resourcesResponse('An array of resource records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_role_byid_parameters() {
    	$content=array(
    	  
	      'roleid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one roleRecord identified by it's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $roleid
    * @return roleRecord[]
    */
    public static function get_role_byid($roleid) {
    	$server = new mdl_m2server();
    	return $server->get_role_byid(0,'',
    	$roleid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_role_byid_returns() {
    	return new oktech_get_role_byidResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_role_byname_parameters() {
    	$content=array(
    	  
	      'rolename'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return one roleRecord identified by it's shortname
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $rolename
    * @return roleRecord[]
    */
    public static function get_role_byname($rolename) {
    	$server = new mdl_m2server();
    	return $server->get_role_byname(0,'',
    	$rolename);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_role_byname_returns() {
    	return new oktech_get_role_bynameResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_roles_parameters() {
    	$content=array(
    	  
	      'roleid'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,''),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,''),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return all known roles in Moodle or an array of roleRecord having $idfield equals to $roleid
     * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $roleid
    * @param string $idfield
    * @return roleRecord[]
    */
    public static function get_roles($roleid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_roles(0,'',
    	$roleid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_roles_returns() {
    	return new oktech_get_rolesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_sections_parameters() {
    	$content=array(
    	  
	      'courseids'	=>new oktech_stringArray('An array of input courses id values to search for. If empty return all sections',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,': the field used to identify courses',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Find and return a list of sections within one or several courses.
    * OK PP tested with php5 5 and python clients
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input courses id values to search for. If empty return all sections
    * @param string $idfield : the field used to identify courses
    * @return sectionRecord[] An array of section records.
    */
    public static function get_sections($courseids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_sections(0,'',
    	$courseids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_sections_returns() {
    	return new oktech_get_sectionsResponse('An array of section records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_string_array_parameters() {
    	$content=array(
    	      	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @return string[]
     */
    public static function get_string_array() {
    	$server = new mdl_m2server();
    	return $server->get_string_array();
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_string_array_returns() {
    	return new oktech_get_string_arrayResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_students_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return students of a course $idcourse identified by $idfield
    * rev 1.6.7 role id (4) is not anymore hardcoded
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @return userRecord[]
        */
    public static function get_students($courseid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_students(0,'',
    	$courseid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_students_returns() {
    	return new oktech_get_studentsResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_teachers_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return teachers and non editing teachers of a course $idcourse identified by $idfield
    * rev 1.6.7 role ids 3 and 4 are not anymore hardcoded
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @return userRecord[]
    */
    public static function get_teachers($courseid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_teachers(0,'',
    	$courseid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_teachers_returns() {
    	return new oktech_get_teachersResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_user_parameters() {
    	$content=array(
    	  
	      'userinfo'	=>new external_value(PARAM_CLEAN,'The Student info to search.',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'the field used to search student',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * get one user record with idfield=userinfo.
     * may return several users records if idfield is not a key
     * eg. proxy.get_user(a,b,'alexis','firstname')
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userinfo The Student info to search.
     * @param string $idfield the field used to search student
     * @return userRecord[]
     */
    public static function get_user($userinfo,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_user(0,'',
    	$userinfo,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_user_returns() {
    	return new oktech_get_userResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_user_byid_parameters() {
    	$content=array(
    	  
	      'userinfo'	=>new external_value(PARAM_INT,' Moodle\'s id .',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Get an user record from it's id  (the main Moodle id key)
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param int $userinfo  Moodle's id .
     * @return userRecord[] Return data (user  record) to be converted into a specific
     *               data format for sending to the client.
     */
    public static function get_user_byid($userinfo) {
    	$server = new mdl_m2server();
    	return $server->get_user_byid(0,'',
    	$userinfo);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_user_byid_returns() {
    	return new oktech_get_user_byidResponse('Return data (user  record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_user_byidnumber_parameters() {
    	$content=array(
    	  
	      'userinfo'	=>new external_value(PARAM_CLEAN,' Moodle\'s id number .',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Get an user record from it's id number (an optional info in Moodle)
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $userinfo  Moodle's id number .
    * @return userRecord[] Return data (user  record) to be converted into a specific
    *               data format for sending to the client.
    */
    public static function get_user_byidnumber($userinfo) {
    	$server = new mdl_m2server();
    	return $server->get_user_byidnumber(0,'',
    	$userinfo);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_user_byidnumber_returns() {
    	return new oktech_get_user_byidnumberResponse('Return data (user  record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_user_byusername_parameters() {
    	$content=array(
    	  
	      'userinfo'	=>new external_value(PARAM_CLEAN,' Moodle\'s login of user.',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * Get an user record from it's login name
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $userinfo  Moodle's login of user.
    * @return userRecord[] Return data (user  record) to be converted into a specific
    *               data format for sending to the client.
    */
    public static function get_user_byusername($userinfo) {
    	$server = new mdl_m2server();
    	return $server->get_user_byusername(0,'',
    	$userinfo);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_user_byusername_returns() {
    	return new oktech_get_user_byusernameResponse('Return data (user  record) to be converted into a specific',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_user_grades_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'The Student ID of the student.',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'the field used to identity student',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find and return student grades for currently enrolled courses  (moodle 1.9)
     *
     * @uses $CFG
     * @use get_grades by first creating an array of courses Moodle's ids
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userid The Student ID of the student.
     * @param string $idfield the field used to identity student
     * @return gradeRecord[] student grades
     *
     */
    public static function get_user_grades($userid,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_user_grades(0,'',
    	$userid,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_user_grades_returns() {
    	return new oktech_get_user_gradesResponse('student grades',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_parameters() {
    	$content=array(
    	  
	      'userids'	=>new oktech_stringArray('An array of input user id values. If empty, all users are returned',VALUE_DEFAULT,array()),
	      'idfield'	=>new external_value(PARAM_CLEAN,': the id field to use for searching users (\'id\', \'idnumber\' ...)',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Find and return a list of user records.
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string[] $userids An array of input user id values. If empty, all users are returned
     * @param string $idfield : the id field to use for searching users ('id', 'idnumber' ...)
     *    not necessarly unique ...
     * examples in Python :
     *       proxy.get_users(a,b,['astrid','pguy','toto'],'username')
     *       proxy.get_users(a,b,['alexis'],'firstname')
     *       proxy.get_users(a,b,['alexis','astrid'],'firstname')
     *       proxy.get_users(a,b,[1],'deleted')
     * @return userRecord[]  An array of user records.
     */
    public static function get_users($userids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->get_users(0,'',
    	$userids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_users_returns() {
    	return new oktech_get_usersResponse(' An array of user records.',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_bycourse_parameters() {
    	$content=array(
    	  
	      'idcourse'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'idfield'	=>new external_value(PARAM_CLEAN,'',VALUE_DEFAULT,'idnumber'),
	      'idrole'	=>new external_value(PARAM_INT,'',VALUE_DEFAULT,0),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return an array of users having role $idrole in course $idcourse identified by $idfield
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $idcourse
    * @param string $idfield
    * @param int $idrole
    * @return userRecord[]
    */
    public static function get_users_bycourse($idcourse,$idfield,$idrole) {
    	$server = new mdl_m2server();
    	return $server->get_users_bycourse(0,'',
    	$idcourse,
    	$idfield,
    	$idrole);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_users_bycourse_returns() {
    	return new oktech_get_users_bycourseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_users_byprofile_parameters() {
    	$content=array(
    	  
	      'profilefieldname'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'profilefieldvalue'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * return an array of users having role $idrole in course $idcourse identified by $idfield
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $profilefieldname
    * @param string $profilefieldvalue
    * @return userRecord[]
    */
    public static function get_users_byprofile($profilefieldname,$profilefieldvalue) {
    	$server = new mdl_m2server();
    	return $server->get_users_byprofile(0,'',
    	$profilefieldname,
    	$profilefieldvalue);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_users_byprofile_returns() {
    	return new oktech_get_users_byprofileResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_version_parameters() {
    	$content=array(
    	      	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * Return WS version.
     *
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @return int
     */
    public static function get_version() {
    	$server = new mdl_m2server();
    	return $server->get_version(0,'');
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  get_version_returns() {
    	return new oktech_get_versionResponse(PARAM_INT,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function has_role_incourse_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'roleid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
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
    * starting at rev 1.8 it must also be here for parsing by genwslp.php
    */
    public static function has_role_incourse($userid,$useridfield,$courseid,$courseidfield,$roleid) {
    	$server = new mdl_m2server();
    	return $server->has_role_incourse(0,'',
    	$userid,
    	$useridfield,
    	$courseid,
    	$courseidfield,
    	$roleid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  has_role_incourse_returns() {
    	return new oktech_has_role_incourseResponse(PARAM_BOOL,VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function message_send_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'message'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**  rev 1.8
     * send an instant message to user identified if (userid,useridfield)
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $message
     * @return affectRecord
     */
    public static function message_send($userid,$useridfield,$message) {
    	$server = new mdl_m2server();
    	return $server->message_send(0,'',
    	$userid,
    	$useridfield,
    	$message);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  message_send_returns() {
    	return new oktech_message_sendResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_group_from_grouping_parameters() {
    	$content=array(
    	  
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupingid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $groupingid
     * @return affectRecord
     */
    public static function remove_group_from_grouping($groupid,$groupingid) {
    	$server = new mdl_m2server();
    	return $server->remove_group_from_grouping(0,'',
    	$groupid,
    	$groupingid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_group_from_grouping_returns() {
    	return new oktech_remove_group_from_groupingResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_noneditingteacher_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * remove a non editing teacher role  to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function remove_noneditingteacher($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->remove_noneditingteacher(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_noneditingteacher_returns() {
    	return new oktech_remove_noneditingteacherResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_student_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * remove a student role  to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function remove_student($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->remove_student(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_student_returns() {
    	return new oktech_remove_studentResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_teacher_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * remove an editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public static function remove_teacher($courseid,$courseidfield,$userid,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->remove_teacher(0,'',
    	$courseid,
    	$courseidfield,
    	$userid,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_teacher_returns() {
    	return new oktech_remove_teacherResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_user_from_cohort_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    public static function remove_user_from_cohort($userid,$groupid) {
    	$server = new mdl_m2server();
    	return $server->remove_user_from_cohort(0,'',
    	$userid,
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_user_from_cohort_returns() {
    	return new oktech_remove_user_from_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_user_from_course_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'courseid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'rolename'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $courseid
     * @param string $rolename
     * @return affectRecord
     */
    public static function remove_user_from_course($userid,$courseid,$rolename) {
    	$server = new mdl_m2server();
    	return $server->remove_user_from_course(0,'',
    	$userid,
    	$courseid,
    	$rolename);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_user_from_course_returns() {
    	return new oktech_remove_user_from_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_user_from_group_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),
	      'groupid'	=>new external_value(PARAM_INT,'',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    public static function remove_user_from_group($userid,$groupid) {
    	$server = new mdl_m2server();
    	return $server->remove_user_from_group(0,'',
    	$userid,
    	$groupid);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_user_from_group_returns() {
    	return new oktech_remove_user_from_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_users_from_cohort_parameters() {
    	$content=array(
    	  
	      'userids'	=>new oktech_stringArray('',VALUE_REQUIRED,false),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'cohortid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'cohortidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * remove users from a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public static function remove_users_from_cohort($userids,$useridfield,$cohortid,$cohortidfield) {
    	$server = new mdl_m2server();
    	return $server->remove_users_from_cohort(0,'',
    	$userids,
    	$useridfield,
    	$cohortid,
    	$cohortidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_users_from_cohort_returns() {
    	return new oktech_remove_users_from_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function remove_users_from_group_parameters() {
    	$content=array(
    	  
	      'userids'	=>new oktech_stringArray('',VALUE_REQUIRED,false),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'groupid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'groupidfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
     * remove users from a group
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $groupid
     * @param string $groupidfield
     * @return enrolRecord[]
     */
    public static function remove_users_from_group($userids,$useridfield,$groupid,$groupidfield) {
    	$server = new mdl_m2server();
    	return $server->remove_users_from_group(0,'',
    	$userids,
    	$useridfield,
    	$groupid,
    	$groupidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  remove_users_from_group_returns() {
    	return new oktech_remove_users_from_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function set_user_profile_values_parameters() {
    	$content=array(
    	  
	      'userid'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'useridfield'	=>new external_value(PARAM_CLEAN,'',VALUE_REQUIRED,'false'),
	      'values'	=>new oktech_profileitemRecordArray('',VALUE_REQUIRED,false),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * @param int $client
    * @param string $sesskey
    * @param string $userid
    * @param string $useridfield
    * @param profileitemRecord[] $values
    * @return profileitemRecord[]
    */
    public static function set_user_profile_values($userid,$useridfield,$values) {
    	$server = new mdl_m2server();
    	return $server->set_user_profile_values(0,'',
    	$userid,
    	$useridfield,
    	$values);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  set_user_profile_values_returns() {
    	return new oktech_set_user_profile_valuesResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function unenrol_students_parameters() {
    	$content=array(
    	  
	      'courseid'	=>new external_value(PARAM_CLEAN,'The course ID number to enrol students',VALUE_REQUIRED,'false'),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,'The field used to identify course (idnumber,id,shortname...)',VALUE_REQUIRED,'false'),
	      'userids'	=>new oktech_stringArray('An array of input user idnumber values for enrolment.',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,'student identifier, default idnumber',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
         * unEnrol users as a student in the given course.
         * prerequisite : corresponding students records MUST exist in Moodle
         * OK PP tested with php5 5 and python clients
         * @param int $client The client session ID.
         * @param string $sesskey The client session key.
         * @param string $courseid The course ID number to enrol students
         * @param string $courseidfield The field used to identify course (idnumber,id,shortname...)
         * @param string[] $userids An array of input user idnumber values for enrolment.
         * @param string $idfield student identifier, default idnumber
         * @return enrolRecord[] Return data (user_student records) to be converted into a
         *               specific data format for sending to the client.
         */
    public static function unenrol_students($courseid,$courseidfield,$userids,$idfield) {
    	$server = new mdl_m2server();
    	return $server->unenrol_students(0,'',
    	$courseid,
    	$courseidfield,
    	$userids,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  unenrol_students_returns() {
    	return new oktech_unenrol_studentsResponse('Return data (user_student records) to be converted into a',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_cohort_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_cohortDatum('',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /** rev 1.7 update a single cohort from Moodle
     * @param int $client
     * @param string $sesskey
     * @param cohortDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return cohortRecord[]
     */
    public static function update_cohort($datum,$idfield) {
    	$server = new mdl_m2server();
    	return $server->update_cohort(0,'',
    	$datum,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_cohort_returns() {
    	return new oktech_update_cohortResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_course_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_courseDatum('',VALUE_REQUIRED,false),
	      'courseidfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param courseDatum $datum
     * @param string $courseidfield  what field in the datum is to be used to find him
     * @return courseRecord[]
     */
    public static function update_course($datum,$courseidfield) {
    	$server = new mdl_m2server();
    	return $server->update_course(0,'',
    	$datum,
    	$courseidfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_course_returns() {
    	return new oktech_update_courseResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_group_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_groupDatum('',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 update a single group from Moodle
     * @param int $client
     * @param string $sesskey
     * @param groupDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return groupRecord[]
     */
    public static function update_group($datum,$idfield) {
    	$server = new mdl_m2server();
    	return $server->update_group(0,'',
    	$datum,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_group_returns() {
    	return new oktech_update_groupResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_grouping_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_groupingDatum('',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 update a single grouping from Moodle
     * @param int $client
     * @param string $sesskey
     * @param groupingDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return groupingRecord[]
     */
    public static function update_grouping($datum,$idfield) {
    	$server = new mdl_m2server();
    	return $server->update_grouping(0,'',
    	$datum,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_grouping_returns() {
    	return new oktech_update_groupingResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_section_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_sectionDatum('',VALUE_REQUIRED,false),
	      'idfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'id'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param sectionDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return sectionRecord[]
     */
    public static function update_section($datum,$idfield) {
    	$server = new mdl_m2server();
    	return $server->update_section(0,'',
    	$datum,
    	$idfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_section_returns() {
    	return new oktech_update_sectionResponse('',VALUE_REQUIRED,false);
    }
    

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_user_parameters() {
    	$content=array(
    	  
	      'datum'	=>new oktech_userDatum('',VALUE_REQUIRED,false),
	      'useridfield'	=>new external_value(PARAM_CLEAN,' what field in the datum is to be used to find him',VALUE_DEFAULT,'idnumber'),    	
    	);
    	return new external_function_parameters($content,'');
    }
    
    
   /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param userDatum $datum
     * @param string $useridfield  what field in the datum is to be used to find him
     * @return userRecord[]
     */
    public static function update_user($datum,$useridfield) {
    	$server = new mdl_m2server();
    	return $server->update_user(0,'',
    	$datum,
    	$useridfield);
    	
    }
    
     /**
     * Returns description of method result value
     * @return external_description
     */
    public static function  update_user_returns() {
    	return new oktech_update_userResponse('',VALUE_REQUIRED,false);
    }
    



}





?>
