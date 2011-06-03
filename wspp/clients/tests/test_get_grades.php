<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_grades
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string[] $courseids
* @param string $courseidfield
* @return  gradeRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_grades($lr->getClient(),$lr->getSessionKey(),'','',$courseids,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
