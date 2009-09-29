<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grades
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param (userCourseIDs) array of userCourseID $courseids
* @return userGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_user_grades($lr->getClient(),$lr->getSessionKey(),'',$courseids);
print_r($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
