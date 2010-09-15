<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user info from Moodle user id
* @param integer $client
* @param string $sesskey
* @param string $userinfo
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
