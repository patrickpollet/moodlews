<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_labels
* @param int $client
* @param string $sesskey
* @param labelDatum[] $labels
* @return  labelRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$labels=array();
$res=$client->edit_labels($lr->getClient(),$lr->getSessionKey(),$labels);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
