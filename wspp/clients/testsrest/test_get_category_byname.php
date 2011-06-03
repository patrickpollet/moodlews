<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_category_byname
* @param int $client
* @param string $sesskey
* @param string $catname
* @return  categoryRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_category_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
