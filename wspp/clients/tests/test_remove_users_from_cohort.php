<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for remove_users_from_cohort
* @param int $client
* @param string $sesskey
* @param string[] $userids
* @param string $useridfield
* @param string $cohortid
* @param string $cohortidfield
* @return  enrolRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->remove_users_from_cohort($lr->getClient(),$lr->getSessionKey(),$userids,'','','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
