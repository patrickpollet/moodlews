<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_wiki
* @param int $client
* @param string $sesskey
* @param wikiDatum $datum
* @return  wikiRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new wikiDatum();
$datum->setAction('');
$datum->setCourse(0);
$datum->setDisablecamelcase(0);
$datum->setEwikiacceptbinary(0);
$datum->setEwikiprinttitle(0);
$datum->setHtmlmode(0);
$datum->setId(0);
$datum->setInitialcontent('');
$datum->setName('');
$datum->setPagename('');
$datum->setRemovepages(0);
$datum->setRevertchanges(0);
$datum->setSetpageflags(0);
$datum->setStrippages(0);
$datum->setSummary('');
$datum->setTimemodified(0);
$datum->setWtype('');
$res=$client->add_wiki($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
