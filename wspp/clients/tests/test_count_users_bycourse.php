<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: count users having a role in a
				course
* @param int $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param int $idrole
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->count_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
