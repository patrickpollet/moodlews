<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for edit_courses
* @param int $client
* @param string $sesskey
* @param courseDatum[] $courses
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$courses=array();
$res=$client->edit_courses($lr->getClient(),$lr->getSessionKey(),$courses);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
