<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: export all data of a quiz
* @param integer $client
* @param string $sesskey
* @param integer $quizid
* @param string $quizformat
* @return quizRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_quiz($lr->getClient(),$lr->getSessionKey(),10,'');
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

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
