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

/**test code for MoodleWS: get current version
* @param integer $client
* @param string $sesskey
* @return string
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_version($lr->getClient(),$lr->getSessionKey());
print($res);
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

/**test code for MoodleWS: Get User Grades in some courses
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $userfield
* @param (getCoursesInput) array of string $courseids
* @param string $courseidfield
* @return getGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_grades($lr->getClient(),$lr->getSessionKey(),'','',$courseids,'');
print_r($res);
print($res->getGrades());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get User Grades in all courses
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGrades());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get all Users Grades in one course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGrades());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Enrol students in a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param (enrolStudentsInput) array of string $userids
* @param string $useridfield
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->enrol_students($lr->getClient(),$lr->getSessionKey(),'','',$userids,'');
print_r($res);
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: UnEnrol students in a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param (enrolStudentsInput) array of string $userids
* @param string $useridfield
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->unenrol_students($lr->getClient(),$lr->getSessionKey(),'','',$userids,'');
print_r($res);
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Get last changes to a Moodle s
				course
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

/**test code for MoodleWS: Get Moodle course categories
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

/**test code for MoodleWS: Get Courses user identified by id
				is member of
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

/**test code for MoodleWS: Get Courses current user identified
				by username is member of
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

/**test code for MoodleWS: Get Courses current user identified
				by idnumber is member of
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

/**test code for MoodleWS: Get user info from Moodle user
				login
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

/**test code for MoodleWS: Get user info from Moodle user id
				number
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

/**test code for MoodleWS: count users having a role in a
				course
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

/**test code for MoodleWS: Get users members of a group in
				course
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

/**test code for MoodleWS: Get users members of a grouping in
				course
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_grouping_members($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: get current user Moodle internal id
				(helper)
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
* @param string $uid
* @param string $idfield
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_groups($lr->getClient(),$lr->getSessionKey(),'','');
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

/**test code for MoodleWS: check if user has a given role in a
				given course
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

/**test code for MoodleWS: returns user s primary role in a
				given course
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

/**test code for MoodleWS: Get user most recent activities in
				a Moodle course
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

/**test code for MoodleWS: count user most recent activities
				in a Moodle course
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

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param userDatum $user
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$user= new userDatum();
$user->setAction('');
$user->setId(0);
$user->setConfirmed(0);
$user->setPolicyagreed(0);
$user->setDeleted(0);
$user->setUsername('');
$user->setAuth('');
$user->setPassword('');
$user->setPasswordmd5('');
$user->setIdnumber('');
$user->setFirstname('');
$user->setLastname('');
$user->setEmail('');
$user->setEmailstop(0);
$user->setIcq('');
$user->setSkype('');
$user->setYahoo('');
$user->setAim('');
$user->setMsn('');
$user->setPhone1('');
$user->setPhone2('');
$user->setInstitution('');
$user->setDepartment('');
$user->setAddress('');
$user->setCity('');
$user->setCountry('');
$user->setLang('');
$user->setTimezone(0);
$user->setLastip('');
$user->setTheme('');
$user->setDescription('');
$user->setMnethostid(0);
$res=$moodle->add_user($lr->getClient(),$lr->getSessionKey(),$user);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param courseDatum $course
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$course= new courseDatum();
$course->setAction('');
$course->setId(0);
$course->setCategory(0);
$course->setSortorder(0);
$course->setPassword('');
$course->setFullname('');
$course->setShortname('');
$course->setIdnumber('');
$course->setSummary('');
$course->setFormat('');
$course->setShowgrades(0);
$course->setNewsitems(0);
$course->setTeacher('');
$course->setTeachers('');
$course->setStudent('');
$course->setStudents('');
$course->setGuest(0);
$course->setStartdate(0);
$course->setEnrolperiod(0);
$course->setMarker(0);
$course->setMaxbytes(0);
$course->setVisible(0);
$course->setHiddensections(0);
$course->setGroupmode(0);
$course->setGroupmodeforce(0);
$course->setLang('');
$course->setTheme('');
$course->setCost('');
$course->setMetacourse(0);
$res=$moodle->add_course($lr->getClient(),$lr->getSessionKey(),$course);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupDatum $group
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$group= new groupDatum();
$group->setAction('');
$group->setId(0);
$group->setCourseid(0);
$group->setName('');
$group->setDescription('');
$group->setEnrolmentkey('');
$group->setPicture(0);
$group->setHidepicture(0);
$res=$moodle->add_group($lr->getClient(),$lr->getSessionKey(),$group);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupingDatum $grouping
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$grouping= new groupingDatum();
$grouping->setAction('');
$grouping->setId(0);
$grouping->setCourseid(0);
$grouping->setName('');
$grouping->setDescription('');
$res=$moodle->add_grouping($lr->getClient(),$lr->getSessionKey(),$grouping);
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course section
* @param integer $client
* @param string $sesskey
* @param sectionDatum $section
* @return editSectionsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$section= new sectionDatum();
$section->setAction('');
$section->setId(0);
$section->setCourse(0);
$section->setSection(0);
$section->setSummary('');
$section->setSequence('');
$section->setVisible(0);
$res=$moodle->add_section($lr->getClient(),$lr->getSessionKey(),$section);
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a label
* @param integer $client
* @param string $sesskey
* @param labelDatum $label
* @return editLabelsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$label= new labelDatum();
$label->setAction('');
$label->setId(0);
$label->setCourse(0);
$label->setName('');
$label->setContent('');
$res=$moodle->add_label($lr->getClient(),$lr->getSessionKey(),$label);
print_r($res);
print($res->getLabels());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a forum
* @param integer $client
* @param string $sesskey
* @param forumDatum $forum
* @return editForumsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$forum= new forumDatum();
$forum->setAction('');
$forum->setId(0);
$forum->setCourse(0);
$forum->setType('');
$forum->setName('');
$forum->setIntro('');
$forum->setAssessed(0);
$forum->setAssesstimestart(0);
$forum->setAssesstimefinish(0);
$forum->setScale(0);
$forum->setMaxbytes(0);
$forum->setForcesubscribe(0);
$forum->setTrackingtype(0);
$forum->setRsstype(0);
$forum->setRssarticles(0);
$forum->setTimemodified(0);
$forum->setWarnafter(0);
$forum->setBlockafter(0);
$forum->setBlockperiod(0);
$res=$moodle->add_forum($lr->getClient(),$lr->getSessionKey(),$forum);
print_r($res);
print($res->getForums());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param databaseDatum $database
* @return editDatabasesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$database= new databaseDatum();
$database->setAction('');
$database->setId(0);
$database->setCourse(0);
$database->setName('');
$database->setIntro('');
$database->setComments(0);
$database->setTimeavailablefrom(0);
$database->setTimeavailableto(0);
$database->setTimeviewfrom(0);
$database->setTimeviewto(0);
$database->setRequiredentries(0);
$database->setRequiredentriestoview(0);
$database->setMaxentries(0);
$database->setRessarticles(0);
$database->setSingletemplate('');
$database->setListtemplate('');
$database->setListtemplateheader('');
$database->setListtemplatefooter('');
$database->setAddtemplatee('');
$database->setRsstemplate('');
$database->setRsstitletemplate('');
$database->setCsstemplate('');
$database->setJstemplate('');
$database->setAsearchtemplate('');
$database->setApproval(0);
$database->setScale(0);
$database->setAssessed(0);
$database->setDefaultsort(0);
$database->setDefaultsortdir(0);
$database->setEditany(0);
$database->setNotification(0);
$res=$moodle->add_database($lr->getClient(),$lr->getSessionKey(),$database);
print_r($res);
print($res->getDatabases());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add an assignment
* @param integer $client
* @param string $sesskey
* @param assignmentDatum $assignment
* @return editAssignmentsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$assignment= new assignmentDatum();
$assignment->setAction('');
$assignment->setId(0);
$assignment->setCourse(0);
$assignment->setName('');
$assignment->setDescription('');
$assignment->setFormat(0);
$assignment->setAssignmenttype('');
$assignment->setResubmit(0);
$assignment->setPreventlate(0);
$assignment->setEmailteachers(0);
$assignment->setVar1(0);
$assignment->setVar2(0);
$assignment->setVar3(0);
$assignment->setVar4(0);
$assignment->setVar5(0);
$assignment->setMaxbytes(0);
$assignment->setTimedue(0);
$assignment->setTimeavailable(0);
$assignment->setGrade(0);
$assignment->setTimemodified(0);
$res=$moodle->add_assignment($lr->getClient(),$lr->getSessionKey(),$assignment);
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param wikiDatum $wiki
* @return editWikisOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$wiki= new wikiDatum();
$wiki->setAction('');
$wiki->setId(0);
$wiki->setName('');
$wiki->setSummary('');
$wiki->setWtype('');
$wiki->setEwikiacceptbinary(0);
$wiki->setCourse(0);
$wiki->setPagename('');
$wiki->setEwikiprinttitle(0);
$wiki->setHtmlmode(0);
$wiki->setDisablecamelcase(0);
$wiki->setSetpageflags(0);
$wiki->setStrippages(0);
$wiki->setRemovepages(0);
$wiki->setRevertchanges(0);
$wiki->setInitialcontent('');
$wiki->setTimemodified(0);
$res=$moodle->add_wiki($lr->getClient(),$lr->getSessionKey(),$wiki);
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param pageWikiDatum $page
* @return editPagesWikiOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$page= new pageWikiDatum();
$page->setAction('');
$page->setId(0);
$page->setPagename('');
$page->setVersion(0);
$page->setFlags(0);
$page->setContent('');
$page->setAuthor('');
$page->setUserid(0);
$page->setCreated(0);
$page->setLastmodified(0);
$page->setRefs('');
$page->setMeta('');
$page->setHits(0);
$page->setWiki(0);
$res=$moodle->add_pagewiki($lr->getClient(),$lr->getSessionKey(),$page);
print_r($res);
print($res->getPagesWiki());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_user($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param categoryDatum $category
* @return editCategoriesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$category= new categoryDatum();
$category->setAction('');
$category->setId(0);
$category->setName('');
$category->setDescription('');
$category->setParent(0);
$category->setSortorder(0);
$category->setVisible(0);
$category->setDepth(0);
$category->setPath('');
$category->setTheme('');
$res=$moodle->add_category($lr->getClient(),$lr->getSessionKey(),$category);
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_course($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_group($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_grouping($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param userDatum $user
* @param string $idfield
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$user= new userDatum();
$user->setAction('');
$user->setId(0);
$user->setConfirmed(0);
$user->setPolicyagreed(0);
$user->setDeleted(0);
$user->setUsername('');
$user->setAuth('');
$user->setPassword('');
$user->setPasswordmd5('');
$user->setIdnumber('');
$user->setFirstname('');
$user->setLastname('');
$user->setEmail('');
$user->setEmailstop(0);
$user->setIcq('');
$user->setSkype('');
$user->setYahoo('');
$user->setAim('');
$user->setMsn('');
$user->setPhone1('');
$user->setPhone2('');
$user->setInstitution('');
$user->setDepartment('');
$user->setAddress('');
$user->setCity('');
$user->setCountry('');
$user->setLang('');
$user->setTimezone(0);
$user->setLastip('');
$user->setTheme('');
$user->setDescription('');
$user->setMnethostid(0);
$res=$moodle->update_user($lr->getClient(),$lr->getSessionKey(),$user,'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param courseDatum $course
* @param string $idfield
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$course= new courseDatum();
$course->setAction('');
$course->setId(0);
$course->setCategory(0);
$course->setSortorder(0);
$course->setPassword('');
$course->setFullname('');
$course->setShortname('');
$course->setIdnumber('');
$course->setSummary('');
$course->setFormat('');
$course->setShowgrades(0);
$course->setNewsitems(0);
$course->setTeacher('');
$course->setTeachers('');
$course->setStudent('');
$course->setStudents('');
$course->setGuest(0);
$course->setStartdate(0);
$course->setEnrolperiod(0);
$course->setMarker(0);
$course->setMaxbytes(0);
$course->setVisible(0);
$course->setHiddensections(0);
$course->setGroupmode(0);
$course->setGroupmodeforce(0);
$course->setLang('');
$course->setTheme('');
$course->setCost('');
$course->setMetacourse(0);
$res=$moodle->update_course($lr->getClient(),$lr->getSessionKey(),$course,'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add a course section
* @param integer $client
* @param string $sesskey
* @param sectionDatum $section
* @param string $idfield
* @return editSectionsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$section= new sectionDatum();
$section->setAction('');
$section->setId(0);
$section->setCourse(0);
$section->setSection(0);
$section->setSummary('');
$section->setSequence('');
$section->setVisible(0);
$res=$moodle->update_section($lr->getClient(),$lr->getSessionKey(),$section,'');
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupDatum $group
* @param string $idfield
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$group= new groupDatum();
$group->setAction('');
$group->setId(0);
$group->setCourseid(0);
$group->setName('');
$group->setDescription('');
$group->setEnrolmentkey('');
$group->setPicture(0);
$group->setHidepicture(0);
$res=$moodle->update_group($lr->getClient(),$lr->getSessionKey(),$group,'');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupingDatum $grouping
* @param string $idfield
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$grouping= new groupingDatum();
$grouping->setAction('');
$grouping->setId(0);
$grouping->setCourseid(0);
$grouping->setName('');
$grouping->setDescription('');
$res=$moodle->update_grouping($lr->getClient(),$lr->getSessionKey(),$grouping,'');
print_r($res);
print($res->getGroupings());

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

/**test code for MoodleWS: Remove the role specified of the
				user in the course
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $courseid
* @param string $rolename
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->remove_user_from_course($lr->getClient(),$lr->getSessionKey(),0,0,'');
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

/**test code for MoodleWS: Get All groupings
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllGroupingsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_groupings($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: unAffect a user to group
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $groupid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->remove_user_from_group($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Edit Groups Information
* @param integer $client
* @param string $sesskey
* @param editGroupingsInput $groupings
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$groupings= new editGroupingsInput();
$groupings->setGroupings(array());
$res=$moodle->edit_groupings($lr->getClient(),$lr->getSessionKey(),$groupings);
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: unAffect a group to grouping
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @param integer $groupingid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->remove_group_from_grouping($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

/**test code for MoodleWS: Affect a group to grouping
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @param integer $groupingid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_group_to_grouping($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
