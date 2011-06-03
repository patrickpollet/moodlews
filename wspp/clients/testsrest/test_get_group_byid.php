<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_group_byid
* @param int $client
* @param string $sesskey
* @param int $groupid
* @return  groupRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_group_byid($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
