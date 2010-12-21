<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grades in some courses
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $userfield
* @param string[] $courseids
* @param string $courseidfield
* @return  getGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$courseids=array();
$res=$client->get_grades($lr->getClient(),$lr->getSessionKey(),'','',$courseids,'');
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
