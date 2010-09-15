<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Users Information
* @param integer $client
* @param string $sesskey
* @param editUsersInput $users
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$users= new editUsersInput();
$users->setUsers(array());
$res=$moodle->edit_users($lr->getClient(),$lr->getSessionKey(),$users);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
