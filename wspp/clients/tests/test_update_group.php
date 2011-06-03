<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for update_group
* @param int $client
* @param string $sesskey
* @param groupDatum $datum
* @param string $idfield
* @return  groupRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new groupDatum();
$datum->setAction('');
$datum->setCourseid(0);
$datum->setDescription('');
$datum->setEnrolmentkey('');
$datum->setHidepicture(0);
$datum->setId(0);
$datum->setName('');
$datum->setPicture(0);
$res=$client->update_group($lr->getClient(),$lr->getSessionKey(),$datum,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
