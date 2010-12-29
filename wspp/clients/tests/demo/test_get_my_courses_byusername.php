<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses current user identified
				by username is member of
* @param integer $client
* @param string $sesskey
* @param string $uinfo
* @param string $sort
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_courses_byusername($lr->getClient(),$lr->getSessionKey(),'toto','');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
