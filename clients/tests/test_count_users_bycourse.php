<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: count users having a role in a
				course
* @param integer $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param integer $idrole
* @return  integer
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->count_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
