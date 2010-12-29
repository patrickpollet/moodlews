<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Users Information
* @param integer $client
* @param string $sesskey
* @param string[] $userids
* @param string $idfield
* @return  getUsersReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->get_users($lr->getClient(),$lr->getSessionKey(),$userids,'');
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
