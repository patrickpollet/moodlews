<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: get users having some value in a profile field
* @param integer $client
* @param string $sesskey
* @param string $profilefieldname
* @param string $profilefieldvalue
* @return  getUsersReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_users_byprofile($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
