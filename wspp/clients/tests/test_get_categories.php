<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_categories
* @param int $client
* @param string $sesskey
* @param string $catid
* @param string $idfield
* @return  categoryRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_categories($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
