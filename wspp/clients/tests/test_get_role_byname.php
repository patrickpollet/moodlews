<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_role_byname
* @param int $client
* @param string $sesskey
* @param string $rolename
* @return  roleRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_role_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
