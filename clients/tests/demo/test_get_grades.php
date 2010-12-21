<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
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

?>
