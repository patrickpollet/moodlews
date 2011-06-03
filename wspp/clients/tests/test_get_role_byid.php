<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_role_byid
* @param int $client
* @param string $sesskey
* @param int $roleid
* @return  roleRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_role_byid($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
