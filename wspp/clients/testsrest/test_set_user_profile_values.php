<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for set_user_profile_values
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param profileitemRecord[] $values
* @return  profileitemRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$values=array();
$res=$client->set_user_profile_values($lr->getClient(),$lr->getSessionKey(),'','',$values);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
