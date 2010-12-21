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
 * affectRecord class
 */
require_once 'affectRecord.php';
/**
 * userRecord class
 */
require_once 'userRecord.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * groupingRecord class
 */
require_once 'groupingRecord.php';
/**
 * cohortRecord class
 */
require_once 'cohortRecord.php';
/**
 * sectionRecord class
 */
require_once 'sectionRecord.php';
/**
 * courseRecord class
 */
require_once 'courseRecord.php';
/**
 * gradeRecord class
 */
require_once 'gradeRecord.php';
/**
 * enrolRecord class
 */
require_once 'enrolRecord.php';
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
 * activityRecord class
 */
require_once 'activityRecord.php';
/**
 * fileRecord class
 */
require_once 'fileRecord.php';
/**
 * profileitemRecord class
 */
require_once 'profileitemRecord.php';
/**
 * assignmentSubmissionRecord class
 */
require_once 'assignmentSubmissionRecord.php';
/**
 * labelRecord class
 */
require_once 'labelRecord.php';
/**
 * forumRecord class
 */
require_once 'forumRecord.php';
/**
 * assignmentRecord class
 */
require_once 'assignmentRecord.php';
/**
 * databaseRecord class
 */
require_once 'databaseRecord.php';
/**
 * wikiRecord class
 */
require_once 'wikiRecord.php';
/**
 * pageWikiRecord class
 */
require_once 'pageWikiRecord.php';
/**
 * quizRecord class
 */
require_once 'quizRecord.php';
/**
 * forumDiscussionRecord class
 */
require_once 'forumDiscussionRecord.php';
/**
 * forumPostRecord class
 */
require_once 'forumPostRecord.php';
/**
 * messageRecord class
 */
require_once 'messageRecord.php';
/**
 * userDatum class
 */
require_once 'userDatum.php';
/**
 * courseDatum class
 */
require_once 'courseDatum.php';
/**
 * labelDatum class
 */
require_once 'labelDatum.php';
/**
 * groupDatum class
 */
require_once 'groupDatum.php';
/**
 * cohortDatum class
 */
require_once 'cohortDatum.php';
/**
 * groupingDatum class
 */
require_once 'groupingDatum.php';
/**
 * categoryDatum class
 */
require_once 'categoryDatum.php';
/**
 * sectionDatum class
 */
require_once 'sectionDatum.php';
/**
 * forumDatum class
 */
require_once 'forumDatum.php';
/**
 * assignmentDatum class
 */
require_once 'assignmentDatum.php';
/**
 * databaseDatum class
 */
require_once 'databaseDatum.php';
/**
 * wikiDatum class
 */
require_once 'wikiDatum.php';
/**
 * pageWikiDatum class
 */
require_once 'pageWikiDatum.php';
/**
 * forumDiscussionDatum class
 */
require_once 'forumDiscussionDatum.php';
/**
 * forumPostDatum class
 */
require_once 'forumPostDatum.php';
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
 * getGroupingsReturn class
 */
require_once 'getGroupingsReturn.php';
/**
 * getCohortsReturn class
 */
require_once 'getCohortsReturn.php';
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
 * getActivitiesReturn class
 */
require_once 'getActivitiesReturn.php';
/**
 * getAssignmentSubmissionsReturn class
 */
require_once 'getAssignmentSubmissionsReturn.php';
/**
 * setUserProfileValuesReturn class
 */
require_once 'setUserProfileValuesReturn.php';
/**
 * editLabelsInput class
 */
require_once 'editLabelsInput.php';
/**
 * editLabelsOutput class
 */
require_once 'editLabelsOutput.php';
/**
 * editGroupsInput class
 */
require_once 'editGroupsInput.php';
/**
 * editGroupsOutput class
 */
require_once 'editGroupsOutput.php';
/**
 * editGroupingsInput class
 */
require_once 'editGroupingsInput.php';
/**
 * editGroupingsOutput class
 */
require_once 'editGroupingsOutput.php';
/**
 * editCohortsInput class
 */
require_once 'editCohortsInput.php';
/**
 * editCohortsOutput class
 */
require_once 'editCohortsOutput.php';
/**
 * editCategoriesInput class
 */
require_once 'editCategoriesInput.php';
/**
 * editCategoriesOutput class
 */
require_once 'editCategoriesOutput.php';
/**
 * editSectionsInput class
 */
require_once 'editSectionsInput.php';
/**
 * editSectionsOutput class
 */
require_once 'editSectionsOutput.php';
/**
 * editForumsInput class
 */
require_once 'editForumsInput.php';
/**
 * editForumsOutput class
 */
require_once 'editForumsOutput.php';
/**
 * editAssignmentsInput class
 */
require_once 'editAssignmentsInput.php';
/**
 * editAssignmentsOutput class
 */
require_once 'editAssignmentsOutput.php';
/**
 * editDatabasesInput class
 */
require_once 'editDatabasesInput.php';
/**
 * editDatabasesOutput class
 */
require_once 'editDatabasesOutput.php';
/**
 * editWikisInput class
 */
require_once 'editWikisInput.php';
/**
 * editWikisOutput class
 */
require_once 'editWikisOutput.php';
/**
 * editPagesWikiInput class
 */
require_once 'editPagesWikiInput.php';
/**
 * editPagesWikiOutput class
 */
require_once 'editPagesWikiOutput.php';
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
 * getAllQuizzesReturn class
 */
require_once 'getAllQuizzesReturn.php';
/**
 * getAllGroupingsReturn class
 */
require_once 'getAllGroupingsReturn.php';
/**
 * getForumDiscussionsReturn class
 */
require_once 'getForumDiscussionsReturn.php';
/**
 * getForumPostsReturn class
 */
require_once 'getForumPostsReturn.php';
/**
 * getMessagesReturn class
 */
require_once 'getMessagesReturn.php';

?>
