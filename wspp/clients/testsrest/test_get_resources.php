<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_resources
* @param int $client
* @param string $sesskey
* @param string[] $courseids
* @param string $idfield
* @return  resourceRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_resources($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
