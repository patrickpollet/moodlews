<?php
/**
 * MoodleWS class file
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

define('DEBUG',true);
if (DEBUG) ini_set('soap.wsdl_cache_enabled', '0');  // no caching by php in debug mode

/**
 * userRecord class
 */
require_once 'userRecord.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * sectionRecord class
 */
require_once 'sectionRecord.php';
/**
 * courseRecord class
 */
require_once 'courseRecord.php';
/**
 * userDatum class
 */
require_once 'userDatum.php';
/**
 * courseDatum class
 */
require_once 'courseDatum.php';
/**
 * gradeRecord class
 */
require_once 'gradeRecord.php';
/**
 * gradeStatsRecord class
 */
require_once 'gradeStatsRecord.php';
/**
 * studentRecord class
 */
require_once 'studentRecord.php';
/**
 * eventRecord class
 */
require_once 'eventRecord.php';
/**
 * changeRecord class
 */
require_once 'changeRecord.php';
/**
 * roleRecord class
 */
require_once 'roleRecord.php';
/**
 * categoryRecord class
 */
require_once 'categoryRecord.php';
/**
 * resourceRecord class
 */
require_once 'resourceRecord.php';
/**
 * studentGradeRecord class
 */
require_once 'studentGradeRecord.php';
/**
 * loginReturn class
 */
require_once 'loginReturn.php';
/**
 * editUsersInput class
 */
require_once 'editUsersInput.php';
/**
 * editUsersOutput class
 */
require_once 'editUsersOutput.php';
/**
 * getUsersReturn class
 */
require_once 'getUsersReturn.php';
/**
 * editCoursesInput class
 */
require_once 'editCoursesInput.php';
/**
 * editCoursesOutput class
 */
require_once 'editCoursesOutput.php';
/**
 * getCoursesReturn class
 */
require_once 'getCoursesReturn.php';
/**
 * getGradesReturn class
 */
require_once 'getGradesReturn.php';
/**
 * enrolStudentsReturn class
 */
require_once 'enrolStudentsReturn.php';
/**
 * getRolesReturn class
 */
require_once 'getRolesReturn.php';
/**
 * getGroupsReturn class
 */
require_once 'getGroupsReturn.php';
/**
 * getEventsReturn class
 */
require_once 'getEventsReturn.php';
/**
 * getLastChangesReturn class
 */
require_once 'getLastChangesReturn.php';
/**
 * getCategoriesReturn class
 */
require_once 'getCategoriesReturn.php';
/**
 * getResourcesReturn class
 */
require_once 'getResourcesReturn.php';
/**
 * getSectionsReturn class
 */
require_once 'getSectionsReturn.php';
/**
 * activityRecord class
 */
require_once 'activityRecord.php';
/**
 * getActivitiesReturn class
 */
require_once 'getActivitiesReturn.php';
/**
 * affectRecord class
 */
require_once 'affectRecord.php';
/**
 * editLabelsInput class
 */
require_once 'editLabelsInput.php';
/**
 * labelDatum class
 */
require_once 'labelDatum.php';
/**
 * editLabelsOutput class
 */
require_once 'editLabelsOutput.php';
/**
 * labelRecord class
 */
require_once 'labelRecord.php';
/**
 * editGroupsInput class
 */
require_once 'editGroupsInput.php';
/**
 * groupDatum class
 */
require_once 'groupDatum.php';
/**
 * editGroupsOutput class
 */
require_once 'editGroupsOutput.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * editCategoriesInput class
 */
require_once 'editCategoriesInput.php';
/**
 * categoryDatum class
 */
require_once 'categoryDatum.php';
/**
 * editCategoriesOutput class
 */
require_once 'editCategoriesOutput.php';
/**
 * editSectionsInput class
 */
require_once 'editSectionsInput.php';
/**
 * sectionDatum class
 */
require_once 'sectionDatum.php';
/**
 * editSectionsOutput class
 */
require_once 'editSectionsOutput.php';
/**
 * editForumsInput class
 */
require_once 'editForumsInput.php';
/**
 * forumDatum class
 */
require_once 'forumDatum.php';
/**
 * editForumsOutput class
 */
require_once 'editForumsOutput.php';
/**
 * forumRecord class
 */
require_once 'forumRecord.php';
/**
 * editAssignmentsInput class
 */
require_once 'editAssignmentsInput.php';
/**
 * assignmentDatum class
 */
require_once 'assignmentDatum.php';
/**
 * editAssignmentsOutput class
 */
require_once 'editAssignmentsOutput.php';
/**
 * assignmentRecord class
 */
require_once 'assignmentRecord.php';
/**
 * editDatabasesInput class
 */
require_once 'editDatabasesInput.php';
/**
 * databaseDatum class
 */
require_once 'databaseDatum.php';
/**
 * editDatabasesOutput class
 */
require_once 'editDatabasesOutput.php';
/**
 * databaseRecord class
 */
require_once 'databaseRecord.php';
/**
 * editWikisInput class
 */
require_once 'editWikisInput.php';
/**
 * wikiDatum class
 */
require_once 'wikiDatum.php';
/**
 * editWikisOutput class
 */
require_once 'editWikisOutput.php';
/**
 * wikiRecord class
 */
require_once 'wikiRecord.php';
/**
 * editPagesWikiInput class
 */
require_once 'editPagesWikiInput.php';
/**
 * pageWikiDatum class
 */
require_once 'pageWikiDatum.php';
/**
 * editPagesWikiOutput class
 */
require_once 'editPagesWikiOutput.php';
/**
 * pageWikiRecord class
 */
require_once 'pageWikiRecord.php';
/**
 * getAllForumsReturn class
 */
require_once 'getAllForumsReturn.php';
/**
 * getAllLabelsReturn class
 */
require_once 'getAllLabelsReturn.php';
/**
 * getAllWikisReturn class
 */
require_once 'getAllWikisReturn.php';
/**
 * getAllPagesWikiReturn class
 */
require_once 'getAllPagesWikiReturn.php';
/**
 * getAllAssignmentsReturn class
 */
require_once 'getAllAssignmentsReturn.php';
/**
 * getAllDatabasesReturn class
 */
require_once 'getAllDatabasesReturn.php';
/**
 * userCourseID class
 */
require_once 'userCourseID.php';
/**
 * userGrade class
 */
require_once 'userGrade.php';

?>
