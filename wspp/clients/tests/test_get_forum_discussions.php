<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param int $forumid
* @param int $limit
* @return  getForumDiscussionsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_forum_discussions($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getForumDiscussions());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
