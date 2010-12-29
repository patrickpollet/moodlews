<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Pages Wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  getAllPagesWikiReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_pagesWiki($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getPageswiki());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
