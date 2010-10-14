<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course($lr->getClient(),$lr->getSessionKey(),'1','category');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
