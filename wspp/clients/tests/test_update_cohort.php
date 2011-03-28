<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param int $client
* @param string $sesskey
* @param cohortDatum $cohort
* @param string $idfield
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
$res=$client->update_cohort($lr->getClient(),$lr->getSessionKey(),$cohort,'');
print_r($res);
print($res->getCohorts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
