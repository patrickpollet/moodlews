<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupDatum $group
* @param string $idfield
* @return  editGroupsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$group= new groupDatum();
$group->setAction('');
$group->setId(0);
$group->setCourseid(0);
$group->setName('');
$group->setDescription('');
$group->setEnrolmentkey('');
$group->setPicture(0);
$group->setHidepicture(0);
$res=$client->update_group($lr->getClient(),$lr->getSessionKey(),$group,'');
print_r($res);
print($res->getGroups());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
