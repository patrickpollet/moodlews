<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Groups Information
* @param int $client
* @param string $sesskey
* @param editGroupsInput $groups
* @return  editGroupsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$groups= new editGroupsInput();
$groups->setGroups(array());
$res=$client->edit_groups($lr->getClient(),$lr->getSessionKey(),$groups);
print_r($res);
print($res->getGroups());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
