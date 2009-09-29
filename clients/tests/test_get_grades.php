<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grades
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param (getGradesInput) array of string $courseids
* @param string $idfield
* @return float
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_grades($lr->getClient(),$lr->getSessionKey(),'',$courseids,'');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
