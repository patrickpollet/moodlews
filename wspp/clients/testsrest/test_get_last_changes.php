<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_last_changes
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @param int $limit
* @return  changeRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_last_changes($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
