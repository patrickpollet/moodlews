<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param cohortDatum $cohort
* @return  editCohortsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$cohort= new cohortDatum();
$cohort->setAction('');
$cohort->setId(0);
$cohort->setCategoryid(0);
$cohort->setName('');
$cohort->setDescription('');
$cohort->setComponent('');
$cohort->setIdnumber('');
$res=$client->add_cohort($lr->getClient(),$lr->getSessionKey(),$cohort);
print_r($res);
print($res->getCohorts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
