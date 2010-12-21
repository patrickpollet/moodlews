<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: set one user profile values
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param (profileitemRecords) array of profileitemRecord $values
* @return setUserProfileValuesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$pr=new ProfileItemRecord('etudiant',1);
$values=array($pr);
$res=$moodle->set_user_profile_values($lr->getClient(),$lr->getSessionKey(),'toto1','username',$values);
print_r($res);
print($res->getProfiles());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
