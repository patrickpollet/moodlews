<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for edit_pagesWiki
* @param int $client
* @param string $sesskey
* @param pageWikiDatum[] $pageswiki
* @return  pageWikiRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$pageswiki=array();
$res=$client->edit_pagesWiki($lr->getClient(),$lr->getSessionKey(),$pageswiki);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
