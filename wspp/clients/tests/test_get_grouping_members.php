<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get users members of a grouping in
				course
* @param int $client
* @param string $sesskey
* @param int $groupid
* @return  getUsersReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_grouping_members($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
