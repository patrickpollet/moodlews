<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
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
$group->setAction('');
$group->setId(0);
$group->setCourseid(0);
$group->setName('');
$group->setDescription('');
$group->setEnrolmentkey('');
$group->setPicture(0);
$group->setHidepicture(0);
$res=$moodle->update_group($lr->getClient(),$lr->getSessionKey(),$group,'');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
