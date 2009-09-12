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
* @return getGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_grades($lr->getClient(),$lr->getSessionKey(),'',$courseids,'');
print_r($res);
print($res->getGrades());

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
* @param integer $courseid
* @param integer $uid
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

?>
