<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for delete_course
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->delete_course($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
