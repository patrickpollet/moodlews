<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grades in all courses
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getGradesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_user_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGrades());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
