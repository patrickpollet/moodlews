<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_messages
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @return  messageRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_messages($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
