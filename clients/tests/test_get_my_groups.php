<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user groups in all Moodle site
* @param integer $client
* @param string $sesskey
* @param string $uid
* @param string $idfield
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_groups($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
