<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_sections
* @param int $client
* @param string $sesskey
* @param string[] $courseids
* @param string $idfield
* @return  sectionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_sections($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
