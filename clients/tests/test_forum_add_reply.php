<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param int $parentid
* @param forumPostDatum $post
* @return  getForumPostsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$post= new forumPostDatum();
$post->setSubject('');
$post->setMessage('');
$res=$client->forum_add_reply($lr->getClient(),$lr->getSessionKey(),0,$post);
print_r($res);
print($res->getForumPosts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
