<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param string $useridto
* @param string $useridtofield
* @param string $useridfrom
* @param string $useridfromfield
* @return  getMessagesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_messages_history($lr->getClient(),$lr->getSessionKey(),'','','','');
print_r($res);
print($res->getMessages());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
