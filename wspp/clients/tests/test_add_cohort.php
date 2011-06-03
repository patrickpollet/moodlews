<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_cohort
* @param int $client
* @param string $sesskey
* @param cohortDatum $datum
* @return  cohortRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new cohortDatum();
$datum->setAction('');
$datum->setCategoryid(0);
$datum->setComponent('');
$datum->setDescription('');
$datum->setId(0);
$datum->setIdnumber('');
$datum->setName('');
$res=$client->add_cohort($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
