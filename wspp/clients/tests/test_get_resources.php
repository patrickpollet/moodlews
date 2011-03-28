<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get resources in courses
* @param int $client
* @param string $sesskey
* @param string[] $courseids
* @param string $idfield
* @return  getResourcesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_resources($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getResources());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
