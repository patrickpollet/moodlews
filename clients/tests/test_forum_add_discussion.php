<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get
* @param int $client
* @param string $sesskey
* @param int $forumid
* @param forumDiscussionDatum $discussion
* @return  getForumDiscussionsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$discussion= new forumDiscussionDatum();
$discussion->setSubject('un essai');
$discussion->setMessage('alors caroule en 1.9');
$res=$client->forum_add_discussion($lr->getClient(),$lr->getSessionKey(),11,$discussion);
print_r($res);
print($res->getForumDiscussions());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
