<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $message
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->message_send($lr->getClient(),$lr->getSessionKey(),'admin','username','un message MDL 195');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
