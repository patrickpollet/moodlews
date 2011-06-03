<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for remove_users_from_group
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
$res=$client->remove_users_from_group($lr->getClient(),$lr->getSessionKey(),$userids,'','','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
