<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_sections
* @param int $client
* @param string $sesskey
* @param sectionDatum[] $sections
* @return  sectionRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$sections=array();
$res=$client->edit_sections($lr->getClient(),$lr->getSessionKey(),$sections);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
