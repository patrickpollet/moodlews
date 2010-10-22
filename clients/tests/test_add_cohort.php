<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param cohortDatum $cohort
* @return editCohortsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$cohort= new cohortDatum();
$cohort->setAction('');
$cohort->setId(0);
$cohort->setCategoryid(0);
$cohort->setName('pcc1a');
$cohort->setDescription('1ere année pcc');
$cohort->setComponent('');
$cohort->setIdnumber('pcc1a');
$res=$moodle->add_cohort($lr->getClient(),$lr->getSessionKey(),$cohort);
print_r($res);
print($res->getCohorts());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
