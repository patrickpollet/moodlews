<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_module_grades
* @param int $client
* @param string $sesskey
* @param int $activityid
* @param string $activitytype
* @param string[] $userids
* @param string $useridfield
* @return  gradeItemRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array('student');
$res=$client->get_module_grades($lr->getClient(),$lr->getSessionKey(),4,'assign',$userids,'username');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
