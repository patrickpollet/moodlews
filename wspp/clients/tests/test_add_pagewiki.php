<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_pagewiki
* @param int $client
* @param string $sesskey
* @param pageWikiDatum $datum
* @return  pageWikiRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new pageWikiDatum();
$datum->setAction('');
$datum->setAuthor('');
$datum->setContent('');
$datum->setCreated(0);
$datum->setFlags(0);
$datum->setHits(0);
$datum->setId(0);
$datum->setLastmodified(0);
$datum->setMeta('');
$datum->setPagename('');
$datum->setRefs('');
$datum->setUserid(0);
$datum->setVersion(0);
$datum->setWiki(0);
$res=$client->add_pagewiki($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
