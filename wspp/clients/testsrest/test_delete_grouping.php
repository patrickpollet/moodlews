<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for delete_grouping
* @param int $client
* @param string $sesskey
* @param string $id
* @param string $idfield
* @return  groupingRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->delete_grouping($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
