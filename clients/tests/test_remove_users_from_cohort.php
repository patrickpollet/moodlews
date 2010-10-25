<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Unenrol students in a cohort
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
$userids=array('toto','toto1','titi');

$res=$moodle->remove_users_from_cohort($lr->getClient(),$lr->getSessionKey(),'1','id',$userids,'username');
print_r($res);
print($res->getStudents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
