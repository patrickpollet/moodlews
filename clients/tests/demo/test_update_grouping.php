<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
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
//$grouping->setAction('');
$grouping->setId(2);
//$grouping->setCourseid(0);
$grouping->setName('grouping a virer oui oui oui ');
$grouping->setDescription('vraiment a virer ');
$res=$moodle->update_grouping($lr->getClient(),$lr->getSessionKey(),$grouping,'id');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
