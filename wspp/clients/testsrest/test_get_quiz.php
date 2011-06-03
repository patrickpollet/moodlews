<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_quiz
* @param int $client
* @param string $sesskey
* @param int $quizid
* @param string $format
* @return  quizRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_quiz($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getCourse());
print($res->getData());
print($res->getError());
print($res->getId());
print($res->getIntro());
print($res->getName());
print($res->getQuestions());
print($res->getShuffleanswers());
print($res->getShufflequestions());
print($res->getTimeclose());
print($res->getTimelimit());
print($res->getTimeopen());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
