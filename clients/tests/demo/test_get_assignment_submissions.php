<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: get files submitted
				in a Moodle assignment
* @param integer $client
* @param string $sesskey
* @param integer $assignmentid
* @param (getUsersInput) array of string $userids
* @param string $useridfield
* @param integer $timemodified
* @return getAssignmentSubmissionsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->get_assignment_submissions($lr->getClient(),$lr->getSessionKey(),0,$userids,'',0);
print_r($res);
print($res->getSubmissions());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
