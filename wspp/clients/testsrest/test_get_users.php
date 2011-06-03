<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_users
* @param int $client
* @param string $sesskey
* @param string[] $userids
* @param string $idfield
* @return  userRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->get_users($lr->getClient(),$lr->getSessionKey(),$userids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
