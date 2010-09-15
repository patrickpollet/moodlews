<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
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

?>
