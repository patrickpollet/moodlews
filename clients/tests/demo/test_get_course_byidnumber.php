<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_course_byidnumber($lr->getClient(),$lr->getSessionKey(),'pp001');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
