<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Forum Information
* @param integer $client
* @param string $sesskey
* @param editForumsInput $forums
* @return editForumsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$forums= new editForumsInput();
$forums->setForums(array());
$res=$moodle->edit_forums($lr->getClient(),$lr->getSessionKey(),$forums);
print_r($res);
print($res->getForums());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
