<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Page of Wiki Information
* @param integer $client
* @param string $sesskey
* @param editPagesWikiInput $pagesWiki
* @return editPagesWikiOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$pagesWiki= new editPagesWikiInput();
$pagesWiki->setPagesWiki(array());
$res=$moodle->edit_pagesWiki($lr->getClient(),$lr->getSessionKey(),$pagesWiki);
print_r($res);
print($res->getPagesWiki());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
