<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param int $client
* @param string $sesskey
* @param wikiDatum $wiki
* @return  editWikisOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$wiki= new wikiDatum();
$wiki->setAction('');
$wiki->setId(0);
$wiki->setName('');
$wiki->setSummary('');
$wiki->setWtype('');
$wiki->setEwikiacceptbinary(0);
$wiki->setCourse(0);
$wiki->setPagename('');
$wiki->setEwikiprinttitle(0);
$wiki->setHtmlmode(0);
$wiki->setDisablecamelcase(0);
$wiki->setSetpageflags(0);
$wiki->setStrippages(0);
$wiki->setRemovepages(0);
$wiki->setRevertchanges(0);
$wiki->setInitialcontent('');
$wiki->setTimemodified(0);
$res=$client->add_wiki($lr->getClient(),$lr->getSessionKey(),$wiki);
print_r($res);
print($res->getWikis());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
