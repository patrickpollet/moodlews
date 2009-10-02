<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Users Information
* @param integer $client
* @param string $sesskey
* @param (getUsersInput) array of string $userids
* @param string $idfield
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$res=$moodle->get_users($lr->getClient(),$lr->getSessionKey(),$userids,'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
