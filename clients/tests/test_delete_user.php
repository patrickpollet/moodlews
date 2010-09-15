<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_user($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
