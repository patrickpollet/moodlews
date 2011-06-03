<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_users
* @param int $client
* @param string $sesskey
* @param userDatum[] $users
* @return  userRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$users=array();
$res=$client->edit_users($lr->getClient(),$lr->getSessionKey(),$users);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
