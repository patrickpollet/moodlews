<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_database
* @param int $client
* @param string $sesskey
* @param databaseDatum $datum
* @return  databaseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new databaseDatum();
$datum->setAction('');
$datum->setAddtemplatee('');
$datum->setApproval(0);
$datum->setAsearchtemplate('');
$datum->setAssessed(0);
$datum->setComments(0);
$datum->setCourse(0);
$datum->setCsstemplate('');
$datum->setDefaultsort(0);
$datum->setDefaultsortdir(0);
$datum->setEditany(0);
$datum->setId(0);
$datum->setIntro('');
$datum->setJstemplate('');
$datum->setListtemplate('');
$datum->setListtemplatefooter('');
$datum->setListtemplateheader('');
$datum->setMaxentries(0);
$datum->setName('');
$datum->setNotification(0);
$datum->setRequiredentries(0);
$datum->setRequiredentriestoview(0);
$datum->setRessarticles(0);
$datum->setRsstemplate('');
$datum->setRsstitletemplate('');
$datum->setScale(0);
$datum->setSingletemplate('');
$datum->setTimeavailablefrom(0);
$datum->setTimeavailableto(0);
$datum->setTimeviewfrom(0);
$datum->setTimeviewto(0);
$res=$client->add_database($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
