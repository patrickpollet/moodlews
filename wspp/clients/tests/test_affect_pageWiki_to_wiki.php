<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect a page of wiki to a wiki
* @param integer $client
* @param string $sesskey
* @param integer $pageid
* @param integer $wikiid
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->affect_pageWiki_to_wiki($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
