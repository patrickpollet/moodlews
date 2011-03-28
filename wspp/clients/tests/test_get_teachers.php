<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get course teachers
* @param int $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return  getUsersReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_teachers($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
