<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All quizzes
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  getAllQuizzesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_quizzes($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getQuizzes());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
