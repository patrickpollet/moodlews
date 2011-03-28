<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user's contacts in Moodle messaging
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @return  getMessageContactsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_message_contacts($lr->getClient(),$lr->getSessionKey(),'9','id');
print_r($res);
print($res->getContacts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
