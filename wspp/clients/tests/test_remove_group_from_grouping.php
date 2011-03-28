<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: unAffect a group to grouping
* @param int $client
* @param string $sesskey
* @param int $groupid
* @param int $groupingid
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->remove_group_from_grouping($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
