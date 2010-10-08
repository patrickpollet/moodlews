<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Courses Information
* @param integer $client
* @param string $sesskey
* @param editCoursesInput $courses
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courses= new editCoursesInput();
$courses->setCourses(array());
$res=$moodle->edit_courses($lr->getClient(),$lr->getSessionKey(),$courses);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
