<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param int $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return  editGroupingsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->delete_grouping($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroupings());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
