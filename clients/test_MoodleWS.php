<?php
require_once ('MoodleWS.php');

$moodle=new MoodleWS();
/**test code for MoodleWS Client Login
* @param string $username
* @param string $password
* @return loginReturn
*/
$res=$moodle->login('','');
print_r($res);
print($res->getClient());
print($res->getSessionkey());


/**test code for MoodleWS: Client Logout
* @param integer $client
* @param string $sesskey
* @return boolean
*/
$res=$moodle->logout(0,'');
print($res);

/**test code for MoodleWS: Edit Users Information
* @param integer $client
* @param string $sesskey
* @param editUsersInput $users
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$users= new editUsersInput();
$users->setUsers(array());
$res=$moodle->edit_users($lr->getClient(),$lr->getSessionKey(),$users);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Users Information
* @param integer $client
* @param string $sesskey
* @param (getUsersInput) array of string $userids
* @param string $idfield
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->get_users($lr->getClient(),$lr->getSessionKey(),$userids,'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Courses Information
* @param integer $client
* @param string $sesskey
* @param editCoursesInput $courses
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courses= new editCoursesInput();
$courses->setCourses(array());
$res=$moodle->edit_courses($lr->getClient(),$lr->getSessionKey(),$courses);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Courses Information
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_courses($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get resources in courses
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @return getResourcesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_resources($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getResources());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course sections
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @return getSectionsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_sections($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get resources in courses
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @param string $type
* @return getResourcesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_instances_bytype($lr->getClient(),$lr->getSessionKey(),$courseids,'','');
print_r($res);
print($res->getResources());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get User Grades
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param (getGradesInput) array of string $courseids
* @param string $idfield
* @return float
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_grades($lr->getClient(),$lr->getSessionKey(),'',$courseids,'');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get User Grade
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $courseid
* @return float
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_grade($lr->getClient(),$lr->getSessionKey(),'','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get User Grades
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param (userCourseIDs) array of userCourseID $courseids
* @return userGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_user_grades($lr->getClient(),$lr->getSessionKey(),'',$courseids);
print_r($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Enrol students in a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param (enrolStudentsInput) array of string $userids
* @param string $idfield
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->enrol_students($lr->getClient(),$lr->getSessionKey(),'',$userids,'');
print_r($res);
print($res->getError());
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Assign instructors to a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param (enrolStudentsInput) array of string $userids
* @param string $idfield
* @param integer $lmsrole
* @param boolean $enrol
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->assign_instructors($lr->getClient(),$lr->getSessionKey(),'',$userids,'',0,false);
print_r($res);
print($res->getError());
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get last changes to a Moodle s course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @param integer $limit
* @return getLastChangesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_last_changes($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
print($res->getChanges());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Moodle s events
* @param integer $client
* @param string $sesskey
* @param integer $eventtype
* @param integer $ownerid
* @return getEventsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_events($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getEvents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course_byidnumber($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get one User Information
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $idfield
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All roles defined in Moodle
* @param integer $client
* @param string $sesskey
* @return getRolesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_roles($lr->getClient(),$lr->getSessionKey());
print_r($res);
print($res->getRoles());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get one role defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getRolesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_role_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getRoles());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get one role defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getRolesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_role_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getRoles());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: assign-unassign user as a member of a group in course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $userid
* @param integer $atigroup
* @param boolean $assign
* @return boolean
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->set_group_member($lr->getClient(),$lr->getSessionKey(),'','',0,false);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: performs a moodle reset of a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $newstartdate
* @param boolean $allincat
* @param boolean $stuonly
* @return boolean
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->reset_course($lr->getClient(),$lr->getSessionKey(),'','',false,false);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get  Moodle  course categories
* @param integer $client
* @param string $sesskey
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_categories($lr->getClient(),$lr->getSessionKey());
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get one category defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_category_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get one category defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_category_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Courses user identified by id is member of
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @param string $sort
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_courses($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Courses current user identified by username is  member of
* @param integer $client
* @param string $sesskey
* @param string $uinfo
* @param string $sort
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_courses_byusername($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Courses current user identified by idnumber is  member of
* @param integer $client
* @param string $sesskey
* @param string $uinfo
* @param string $sort
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_courses_byidnumber($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user info from Moodle user login
* @param integer $client
* @param string $sesskey
* @param string $userinfo
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_byusername($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user info from Moodle user id number
* @param integer $client
* @param string $sesskey
* @param string $userinfo
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_byidnumber($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user info from Moodle user id
* @param integer $client
* @param string $sesskey
* @param string $userinfo
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get users having a role in a course
* @param integer $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param integer $idrole
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: count users having a role in a course
* @param integer $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param integer $idrole
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->count_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Courses belonging to category
* @param integer $client
* @param string $sesskey
* @param integer $categoryid
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_courses_bycategory($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course groups
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_groups_bycourse($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_group_byid($lr->getClient(),$lr->getSessionKey(),'',0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_groups_byname($lr->getClient(),$lr->getSessionKey(),'',0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get users members of a group in course
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_group_members($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: get current user Moodle internal id (helper)
* @param integer $client
* @param string $sesskey
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_id($lr->getClient(),$lr->getSessionKey());
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user group in course
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_group($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user groups in all Moodle site
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_groups($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get course teachers
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_teachers($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get course students
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_students($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: check if user has a given role in a given course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @param integer $idrole
* @return boolean
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->has_role_incourse($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: returns  user s primary role in a given course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_primaryrole_incourse($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get user most recent activities in a Moodle course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @param integer $idlimit
* @return getActivitiesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_activities($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print_r($res);
print($res->getActivities());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: count user most recent activities in a Moodle course
* @param integer $client
* @param string $sesskey
* @param string $value1
* @param string $id1
* @param string $value2
* @param string $id2
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->count_activities($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Label Information
* @param integer $client
* @param string $sesskey
* @param editLabelsInput $labels
* @return editLabelsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$labels= new editLabelsInput();
$labels->setLabels(array());
$res=$moodle->edit_labels($lr->getClient(),$lr->getSessionKey(),$labels);
print_r($res);
print($res->getLabels());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Groups Information
* @param integer $client
* @param string $sesskey
* @param editGroupsInput $groups
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$groups= new editGroupsInput();
$groups->setGroups(array());
$res=$moodle->edit_groups($lr->getClient(),$lr->getSessionKey(),$groups);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Assignment Information
* @param integer $client
* @param string $sesskey
* @param editAssignmentsInput $assignments
* @return editAssignmentsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$assignments= new editAssignmentsInput();
$assignments->setAssignments(array());
$res=$moodle->edit_assignments($lr->getClient(),$lr->getSessionKey(),$assignments);
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit databases Information
* @param integer $client
* @param string $sesskey
* @param editDatabasesInput $databases
* @return editDatabasesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$databases= new editDatabasesInput();
$databases->setDatabases(array());
$res=$moodle->edit_databases($lr->getClient(),$lr->getSessionKey(),$databases);
print_r($res);
print($res->getDatabases());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Categories Information
* @param integer $client
* @param string $sesskey
* @param editCategoriesInput $categories
* @return editCategoriesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$categories= new editCategoriesInput();
$categories->setCategories(array());
$res=$moodle->edit_categories($lr->getClient(),$lr->getSessionKey(),$categories);
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit section Information
* @param integer $client
* @param string $sesskey
* @param editSectionsInput $sections
* @return editSectionsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$sections= new editSectionsInput();
$sections->setSections(array());
$res=$moodle->edit_sections($lr->getClient(),$lr->getSessionKey(),$sections);
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Forum Information
* @param integer $client
* @param string $sesskey
* @param editForumsInput $forums
* @return editForumsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$forums= new editForumsInput();
$forums->setForums(array());
$res=$moodle->edit_forums($lr->getClient(),$lr->getSessionKey(),$forums);
print_r($res);
print($res->getForums());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Wikis Information
* @param integer $client
* @param string $sesskey
* @param editWikisInput $wikis
* @return editWikisOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$wikis= new editWikisInput();
$wikis->setWikis(array());
$res=$moodle->edit_wikis($lr->getClient(),$lr->getSessionKey(),$wikis);
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Page of Wiki Information
* @param integer $client
* @param string $sesskey
* @param editPagesWikiInput $pagesWiki
* @return editPagesWikiOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$pagesWiki= new editPagesWikiInput();
$pagesWiki->setPagesWiki(array());
$res=$moodle->edit_pagesWiki($lr->getClient(),$lr->getSessionKey(),$pagesWiki);
print_r($res);
print($res->getPagesWiki());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect Course To Category
* @param integer $client
* @param string $sesskey
* @param integer $courseid
* @param integer $categoryid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_course_to_category($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect Label to Section
* @param integer $client
* @param string $sesskey
* @param integer $labelid
* @param integer $sectionid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_label_to_section($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect Forum to Section
* @param integer $client
* @param string $sesskey
* @param integer $forumid
* @param integer $sectionid
* @param integer $groupmode
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_forum_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect Section To Course
* @param integer $client
* @param string $sesskey
* @param integer $sectionid
* @param integer $courseid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_section_to_course($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a user to group
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $groupid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_user_to_group($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a group to course
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @param integer $coursid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_group_to_course($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a wiki to section
* @param integer $client
* @param string $sesskey
* @param integer $wikiid
* @param integer $sectionid
* @param integer $groupmode
* @param integer $visible
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_wiki_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a database to section
* @param integer $client
* @param string $sesskey
* @param integer $databaseid
* @param integer $sectionid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_database_to_section($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a section to assignment
* @param integer $client
* @param string $sesskey
* @param integer $assignmentid
* @param integer $sectionid
* @param integer $groupmode
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_assignment_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect user to the course
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $courseid
* @param string $rolename
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_user_to_course($lr->getClient(),$lr->getSessionKey(),0,0,'');
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a page of wiki to a wiki
* @param integer $client
* @param string $sesskey
* @param integer $pageid
* @param integer $wikiid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_pageWiki_to_wiki($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Remove the role specified of the user in the course
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $courseid
* @param string $rolename
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->remove_userRole_from_course($lr->getClient(),$lr->getSessionKey(),0,0,'');
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Groups
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_groups($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Forums
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllForumsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_forums($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getForums());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Labels
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllLabelsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_labels($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getLabels());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllWikisReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_wikis($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Pages Wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllPagesWikiReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_pagesWiki($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getPageswiki());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Assignments
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllAssignmentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_assignments($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get All Databases
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllDatabasesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_databases($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getDatabases());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
