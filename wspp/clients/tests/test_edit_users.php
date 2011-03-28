<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Users Information
* @param int $client
* @param string $sesskey
* @param editUsersInput $users
* @return  editUsersOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$users= new editUsersInput();
$users->setUsers(array());
$res=$client->edit_users($lr->getClient(),$lr->getSessionKey(),$users);
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
