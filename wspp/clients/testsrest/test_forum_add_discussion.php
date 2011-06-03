<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for forum_add_discussion
* @param int $client
* @param string $sesskey
* @param int $forumid
* @param forumDiscussionDatum $discussion
* @return  forumDiscussionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$discussion= new forumDiscussionDatum();
$discussion->setMessage('');
$discussion->setSubject('');
$res=$client->forum_add_discussion($lr->getClient(),$lr->getSessionKey(),0,$discussion);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
