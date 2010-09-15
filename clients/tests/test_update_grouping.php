<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param groupingDatum $grouping
* @param string $idfield
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$grouping= new groupingDatum();
$grouping->setAction('');
$grouping->setId(0);
$grouping->setCourseid(0);
$grouping->setName('');
$grouping->setDescription('');
$res=$moodle->update_grouping($lr->getClient(),$lr->getSessionKey(),$grouping,'');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
