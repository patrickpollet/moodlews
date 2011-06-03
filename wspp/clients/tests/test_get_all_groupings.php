<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_all_groupings
* @param int $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  groupingRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_groupings($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
