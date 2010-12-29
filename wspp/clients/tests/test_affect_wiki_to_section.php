<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect a wiki to section
* @param integer $client
* @param string $sesskey
* @param integer $wikiid
* @param integer $sectionid
* @param integer $groupmode
* @param integer $visible
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->affect_wiki_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
