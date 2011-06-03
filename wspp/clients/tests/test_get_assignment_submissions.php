<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_assignment_submissions
* @param int $client
* @param string $sesskey
* @param int $assignmentid
* @param string[] $userids
* @param string $useridfield
* @param int $timemodified
* @param int $zipfiles
* @return  assignmentSubmissionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->get_assignment_submissions($lr->getClient(),$lr->getSessionKey(),0,$userids,'',0,0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
