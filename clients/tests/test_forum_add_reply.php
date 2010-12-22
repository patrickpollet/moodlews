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
$post->setSubject('re: alors');
$post->setMessage('on dirait bien');
$res=$client->forum_add_reply($lr->getClient(),$lr->getSessionKey(),1052,$post);
print_r($res);
print($res->getForumPosts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
