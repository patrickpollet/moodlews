<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param wikiDatum $wiki
* @return editWikisOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
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
$res=$moodle->add_wiki($lr->getClient(),$lr->getSessionKey(),$wiki);
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
