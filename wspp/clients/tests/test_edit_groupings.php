<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_groupings
* @param int $client
* @param string $sesskey
* @param groupingDatum[] $groupings
* @return  groupingRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$groupings=array();
$res=$client->edit_groupings($lr->getClient(),$lr->getSessionKey(),$groupings);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
