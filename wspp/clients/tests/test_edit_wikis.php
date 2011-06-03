<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_wikis
* @param int $client
* @param string $sesskey
* @param wikiDatum[] $wikis
* @return  wikiRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$wikis=array();
$res=$client->edit_wikis($lr->getClient(),$lr->getSessionKey(),$wikis);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
