<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Groups
* @param int $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  getGroupsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_groups($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
