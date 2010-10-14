<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Groups
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_groups($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
