<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Forum Information
* @param int $client
* @param string $sesskey
* @param editForumsInput $forums
* @return  editForumsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$forums= new editForumsInput();
$forums->setForums(array());
$res=$client->edit_forums($lr->getClient(),$lr->getSessionKey(),$forums);
print_r($res);
print($res->getForums());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
