<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for edit_groups
* @param int $client
* @param string $sesskey
* @param groupDatum[] $groups
* @return  groupRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$groups=array();
$res=$client->edit_groups($lr->getClient(),$lr->getSessionKey(),$groups);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
