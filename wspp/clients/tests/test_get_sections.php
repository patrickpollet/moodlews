<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course sections
* @param int $client
* @param string $sesskey
* @param string[] $courseids
* @param string $idfield
* @return  getSectionsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_sections($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getSections());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
