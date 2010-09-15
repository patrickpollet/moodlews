<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Groups Information
* @param integer $client
* @param string $sesskey
* @param editGroupsInput $groups
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$groups= new editGroupsInput();
$groups->setGroups(array());
$res=$moodle->edit_groups($lr->getClient(),$lr->getSessionKey(),$groups);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
