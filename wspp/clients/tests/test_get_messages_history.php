<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_messages_history
* @param int $client
* @param string $sesskey
* @param string $useridto
* @param string $useridtofield
* @param string $useridfrom
* @param string $useridfromfield
* @return  messageRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_messages_history($lr->getClient(),$lr->getSessionKey(),'','','','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
