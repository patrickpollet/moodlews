<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for enrol_students
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param string[] $userids
* @param string $idfield
* @return  enrolRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->enrol_students($lr->getClient(),$lr->getSessionKey(),'','',$userids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
