<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for count_users_bycourse
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @param int $roleid
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->count_users_bycourse($lr->getClient(),$lr->getSessionKey(),'','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
