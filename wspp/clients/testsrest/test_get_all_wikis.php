<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_all_wikis
* @param int $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  wikiRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_wikis($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
