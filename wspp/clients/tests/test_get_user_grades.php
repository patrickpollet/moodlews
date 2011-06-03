<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_user_grades
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $idfield
* @return  gradeRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_user_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
