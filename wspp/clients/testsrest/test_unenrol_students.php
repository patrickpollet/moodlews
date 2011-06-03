<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for unenrol_students
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
$res=$client->unenrol_students($lr->getClient(),$lr->getSessionKey(),'','',$userids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
