<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for edit_assignments
* @param int $client
* @param string $sesskey
* @param assignmentDatum[] $assignments
* @return  assignmentRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$assignments=array();
$res=$client->edit_assignments($lr->getClient(),$lr->getSessionKey(),$assignments);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
