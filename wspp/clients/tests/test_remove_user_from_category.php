<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for remove_user_from_course
* @param int $client
* @param string $sesskey
* @param int $userid
* @param int $courseid
* @param string $rolename
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->remove_user_from_category($lr->getClient(),$lr->getSessionKey(),0,0,'');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
