<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: get files submitted
				in a Moodle assignment
* @param integer $client
* @param string $sesskey
* @param integer $assignmentid
* @param string[] $userids
* @param string $useridfield
* @param integer $timemodified
* @return  getAssignmentSubmissionsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->get_assignment_submissions($lr->getClient(),$lr->getSessionKey(),0,$userids,'',0);
print_r($res);
print($res->getSubmissions());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
