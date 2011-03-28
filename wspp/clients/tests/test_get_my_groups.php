<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user groups in all Moodle site
* @param int $client
* @param string $sesskey
* @param string $uid
* @param string $idfield
* @return  getGroupsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_groups($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
