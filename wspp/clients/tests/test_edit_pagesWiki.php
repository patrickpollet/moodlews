<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Page of Wiki Information
* @param integer $client
* @param string $sesskey
* @param editPagesWikiInput $pagesWiki
* @return  editPagesWikiOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$pagesWiki= new editPagesWikiInput();
$pagesWiki->setPagesWiki(array());
$res=$client->edit_pagesWiki($lr->getClient(),$lr->getSessionKey(),$pagesWiki);
print_r($res);
print($res->getPagesWiki());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
