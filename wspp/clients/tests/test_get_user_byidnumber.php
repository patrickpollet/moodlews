<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user info from Moodle user id
				number
* @param integer $client
* @param string $sesskey
* @param string $userinfo
* @return  getUsersReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_user_byidnumber($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getUsers());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
