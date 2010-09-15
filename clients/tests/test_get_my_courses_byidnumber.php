<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
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

?>
