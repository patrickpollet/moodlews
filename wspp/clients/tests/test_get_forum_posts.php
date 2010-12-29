<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param int $discussionid
* @param int $limit
* @return  getForumPostsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_forum_posts($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getForumPosts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
