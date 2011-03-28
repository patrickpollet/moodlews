<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user group in course
* @param int $client
* @param string $sesskey
* @param int $uid
* @param string $idfield
* @param int $courseid
* @param string $courseidfield
* @return  getGroupsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_group($lr->getClient(),$lr->getSessionKey(),0,'',0,'');
print_r($res);
print($res->getGroups());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
