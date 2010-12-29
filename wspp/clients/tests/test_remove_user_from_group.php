<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: unAffect a user to group
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $groupid
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->remove_user_from_group($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
