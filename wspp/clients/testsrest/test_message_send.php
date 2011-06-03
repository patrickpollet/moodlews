<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for message_send
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $message
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->message_send($lr->getClient(),$lr->getSessionKey(),'','','');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
