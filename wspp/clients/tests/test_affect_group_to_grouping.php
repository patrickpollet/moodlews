<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect a group to grouping
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @param integer $groupingid
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->affect_group_to_grouping($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
