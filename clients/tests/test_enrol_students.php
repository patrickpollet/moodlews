<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
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

?>
