<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect Forum to Section
* @param integer $client
* @param string $sesskey
* @param integer $forumid
* @param integer $sectionid
* @param integer $groupmode
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_forum_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
