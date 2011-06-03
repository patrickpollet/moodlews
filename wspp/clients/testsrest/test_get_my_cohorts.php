<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_my_cohorts
* @param int $client
* @param string $sesskey
* @param string $uid
* @param string $idfield
* @return  cohortRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_cohorts($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
