<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect Forum to Section
* @param int $client
* @param string $sesskey
* @param int $forumid
* @param int $sectionid
* @param int $groupmode
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->affect_forum_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
