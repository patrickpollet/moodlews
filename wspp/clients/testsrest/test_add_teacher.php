<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for add_teacher
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param string $userid
* @param string $useridfield
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->add_teacher($lr->getClient(),$lr->getSessionKey(),'','','','');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
