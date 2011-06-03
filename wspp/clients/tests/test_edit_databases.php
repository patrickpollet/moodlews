<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_databases
* @param int $client
* @param string $sesskey
* @param databaseDatum[] $databases
* @return  databaseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$databases=array();
$res=$client->edit_databases($lr->getClient(),$lr->getSessionKey(),$databases);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
