<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get users having a role in a course
* @param integer $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param integer $idrole
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
