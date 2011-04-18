<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get grade(s) of an activity of a certain type identified by instance id for a list of userids
* @param int $client
* @param string $sesskey
* @param int $id
* @param string $type
* @param string[] $userids
* @param string $useridfield
* @return  getModuleGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->get_module_grades($lr->getClient(),$lr->getSessionKey(),17,'quiz',$userids,'');
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
