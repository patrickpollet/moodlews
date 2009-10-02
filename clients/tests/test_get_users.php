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
$userids=array('alexis','alainxxxx');
$res=$moodle->get_users($lr->getClient(),$lr->getSessionKey(),$userids,'firstname');
//print_r($res);
print_r($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
