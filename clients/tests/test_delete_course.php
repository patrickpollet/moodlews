<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_course($lr->getClient(),$lr->getSessionKey(),'testpp001','idnumber');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
