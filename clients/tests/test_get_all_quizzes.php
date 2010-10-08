<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All quizzes
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllQuizzesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_quizzes($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getQuizzes());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
