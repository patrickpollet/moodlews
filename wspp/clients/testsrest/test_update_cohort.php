<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for update_cohort
* @param int $client
* @param string $sesskey
* @param cohortDatum $datum
* @param string $idfield
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
$res=$client->update_cohort($lr->getClient(),$lr->getSessionKey(),$datum,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
