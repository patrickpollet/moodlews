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
$discussion->setSubject('');
$discussion->setMessage('');
$res=$client->forum_add_discussion($lr->getClient(),$lr->getSessionKey(),0,$discussion);
print_r($res);
print($res->getForumDiscussions());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
