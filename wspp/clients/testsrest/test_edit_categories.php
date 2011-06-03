<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for edit_categories
* @param int $client
* @param string $sesskey
* @param categoryDatum[] $categories
* @return  categoryRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$categories=array();
$res=$client->edit_categories($lr->getClient(),$lr->getSessionKey(),$categories);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
