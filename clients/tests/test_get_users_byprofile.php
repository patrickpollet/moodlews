<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: get users having some value in a profile field
* @param integer $client
* @param string $sesskey
* @param string $profilefieldname
* @param string $profilefieldvalue
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_users_byprofile($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
