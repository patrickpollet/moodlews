<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_courses_bycategory
* @param int $client
* @param string $sesskey
* @param string $catid
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_courses_bycategory($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
