<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_label
* @param int $client
* @param string $sesskey
* @param labelDatum $datum
* @return  labelRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new labelDatum();
$datum->setAction('');
$datum->setContent('');
$datum->setCourse(0);
$datum->setId(0);
$datum->setName('');
$res=$client->add_label($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
