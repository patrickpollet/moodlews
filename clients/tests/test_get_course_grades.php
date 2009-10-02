<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get all Users  Grades in one course
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

?>
