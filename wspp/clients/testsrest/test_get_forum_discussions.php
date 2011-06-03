<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_forum_discussions
* @param int $client
* @param string $sesskey
* @param int $forumid
* @param int $limit
* @return  forumDiscussionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_forum_discussions($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
