<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: count users having a role in a
				course
* @param integer $client
* @param string $sesskey
* @param string $idcourse
* @param string $idfield
* @param integer $idrole
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->count_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
