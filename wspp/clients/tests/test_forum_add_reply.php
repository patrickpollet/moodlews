<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for forum_add_reply
* @param int $client
* @param string $sesskey
* @param int $parentid
* @param forumPostDatum $post
* @return  forumPostRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$post= new forumPostDatum();
$post->setMessage('');
$post->setSubject('');
$res=$client->forum_add_reply($lr->getClient(),$lr->getSessionKey(),0,$post);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
