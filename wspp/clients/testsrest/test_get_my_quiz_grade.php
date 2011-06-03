<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_my_quiz_grade
* @param int $client
* @param string $sesskey
* @param int $quizid
* @return  gradeItemRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_quiz_grade($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
