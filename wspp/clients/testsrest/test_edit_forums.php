<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for edit_forums
* @param int $client
* @param string $sesskey
* @param forumDatum[] $forums
* @return  forumRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$forums=array();
$res=$client->edit_forums($lr->getClient(),$lr->getSessionKey(),$forums);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
