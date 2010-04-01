<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses Information
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_courses_search($lr->getClient(),$lr->getSessionKey(),'pascal 2a pp');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
