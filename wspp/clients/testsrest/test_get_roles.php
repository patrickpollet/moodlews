<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_roles
* @param int $client
* @param string $sesskey
* @param string $roleid
* @param string $idfield
* @return  roleRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
print_r($lr);
$res=$client->get_roles($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
