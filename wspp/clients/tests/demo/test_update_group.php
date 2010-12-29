<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupDatum $group
* @param string $idfield
* @return editGroupsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$group= new groupDatum();
//$group->setAction('');
$group->setId(3);
//$group->setCourseid(0);
$group->setName('groupe a virer vraiment');
$group->setDescription('descro');
$group->setEnrolmentkey('azerty');
$group->setPicture(0);
$group->setHidepicture(0);
$res=$moodle->update_group($lr->getClient(),$lr->getSessionKey(),$group,'id');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
