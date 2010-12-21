<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param pageWikiDatum $page
* @return  editPagesWikiOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$page= new pageWikiDatum();
$page->setAction('');
$page->setId(0);
$page->setPagename('');
$page->setVersion(0);
$page->setFlags(0);
$page->setContent('');
$page->setAuthor('');
$page->setUserid(0);
$page->setCreated(0);
$page->setLastmodified(0);
$page->setRefs('');
$page->setMeta('');
$page->setHits(0);
$page->setWiki(0);
$res=$client->add_pagewiki($lr->getClient(),$lr->getSessionKey(),$page);
print_r($res);
print($res->getPagesWiki());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
