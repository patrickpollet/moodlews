<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: set one user profile values
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param profileitemRecord[] $values
* @return  setUserProfileValuesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$values=array();
$res=$client->set_user_profile_values($lr->getClient(),$lr->getSessionKey(),'','',$values);
print_r($res);
print($res->getProfiles());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
