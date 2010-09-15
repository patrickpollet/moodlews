<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect a wiki to section
* @param integer $client
* @param string $sesskey
* @param integer $wikiid
* @param integer $sectionid
* @param integer $groupmode
* @param integer $visible
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_wiki_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
