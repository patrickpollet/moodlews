<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_forum_posts
* @param int $client
* @param string $sesskey
* @param int $discussionid
* @param int $limit
* @return  forumPostRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_forum_posts($lr->getClient(),$lr->getSessionKey(),630,0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
