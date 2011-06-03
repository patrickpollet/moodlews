<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_resourcefile_byid
* @param int $client
* @param string $sesskey
* @param int $resourceid
* @return  fileRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_resourcefile_byid($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getFilecontent());
print($res->getFilename());
print($res->getFilepath());
print($res->getFilesize());
print($res->getFileurl());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
