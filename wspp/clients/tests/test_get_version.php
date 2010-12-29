<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: get current version
* @param integer $client
* @param string $sesskey
* @return  string
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_version($lr->getClient(),$lr->getSessionKey());
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
