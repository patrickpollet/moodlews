<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: export all data of a quiz
* @param int $client
* @param string $sesskey
* @param int $quizid
* @param string $quizformat
* @return  quizRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_quiz($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getError());
print($res->getId());
print($res->getCourse());
print($res->getName());
print($res->getIntro());
print($res->getTimeopen());
print($res->getTimeclose());
print($res->getShufflequestions());
print($res->getShuffleanswers());
print($res->getQuestions());
print($res->getTimelimit());
print($res->getData());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
