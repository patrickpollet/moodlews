<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Assign instructors to a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param (enrolStudentsInput) array of string $userids
* @param string $idfield
* @param integer $lmsrole
* @param boolean $enrol
* @return enrolStudentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->assign_instructors($lr->getClient(),$lr->getSessionKey(),'',$userids,'',0,false);
print_r($res);
print($res->getError());
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
