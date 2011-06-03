<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for affect_users_to_group
* @param int $client
* @param string $sesskey
* @param string[] $userids
* @param string $useridfield
* @param string $groupid
* @param string $groupidfield
* @return  enrolRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->affect_users_to_group($lr->getClient(),$lr->getSessionKey(),$userids,'','','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
