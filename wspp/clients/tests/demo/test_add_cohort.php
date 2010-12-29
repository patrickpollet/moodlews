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
//$cohort->setId(0);
$cohort->setCategoryid(1);
$cohort->setName('testWSdans1');
$cohort->setDescription('test ajout WS dans categorie 1');
$cohort->setComponent('');
$cohort->setIdnumber('testwsdans1');
print_r($cohort);
$res=$moodle->add_cohort($lr->getClient(),$lr->getSessionKey(),$cohort);
print_r($res);
print($res->getCohorts());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
