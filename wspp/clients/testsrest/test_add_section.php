<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for add_section
* @param int $client
* @param string $sesskey
* @param sectionDatum $datum
* @return  sectionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new sectionDatum();
$datum->setAction('');
$datum->setCourse(0);
$datum->setId(0);
$datum->setSection(0);
$datum->setSequence('');
$datum->setSummary('');
$datum->setVisible(0);
$res=$client->add_section($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
