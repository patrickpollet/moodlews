<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_course_byidnumber
* @param int $client
* @param string $sesskey
* @param string $info
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_course_byidnumber($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
