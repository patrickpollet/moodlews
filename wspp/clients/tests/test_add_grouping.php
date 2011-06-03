<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_grouping
* @param int $client
* @param string $sesskey
* @param groupingDatum $datum
* @return  groupingRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new groupingDatum();
$datum->setAction('');
$datum->setCourseid(0);
$datum->setDescription('');
$datum->setId(0);
$datum->setName('');
$res=$client->add_grouping($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
