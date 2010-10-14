<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: UnEnrol students in a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param (enrolStudentsInput) array of string $userids
* @param string $useridfield
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array(3);
$res=$moodle->unenrol_students($lr->getClient(),$lr->getSessionKey(),'pp002','idnumber',$userids,'id');
print_r($res);
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
