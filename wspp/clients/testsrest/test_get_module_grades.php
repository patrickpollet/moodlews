<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
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
$userids=array();
$res=$client->get_module_grades($lr->getClient(),$lr->getSessionKey(),0,'',$userids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
