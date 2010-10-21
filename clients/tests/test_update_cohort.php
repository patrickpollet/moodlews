<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param cohortDatum $cohort
* @param string $idfield
* @return editCohortsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$cohort= new cohortDatum();
$cohort->setAction('');
$cohort->setId(0);
$cohort->setCategoryid(0);
$cohort->setName('');
$cohort->setDescription('');
$cohort->setComponent('');
$cohort->setIdnumber('');
$res=$moodle->update_cohort($lr->getClient(),$lr->getSessionKey(),$cohort,'');
print_r($res);
print($res->getCohorts());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
