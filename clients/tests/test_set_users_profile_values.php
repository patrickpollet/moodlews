<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: set users profile values
* @param integer $client
* @param string $sesskey
* @param (getUsersInput) array of string $userids
* @param string $useridfield
* @param (profileitemRecords) array of profileitemRecord $values
* @return profileitemRecords
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$userids=array();
$values=array();
$res=$moodle->set_users_profile_values($lr->getClient(),$lr->getSessionKey(),$userids,'',$values);
print_r($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
