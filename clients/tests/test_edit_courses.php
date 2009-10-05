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
$course= new courseDatum();
$course->setAction('update');
//$course->setId(0);
$course->setCategory(4);
//$course->setSortorder(0);
$course->setPassword('pwd');
$course->setFullname('test PP upd');
$course->setShortname('testpp001x');
$course->setIdnumber('testpp001');  //on ne peut pas le changer !!!!
$course->setSummary('resumé resumé');



$courses= new editCoursesInput();
$courses->setCourses(array($course));
print_r($courses);
$res=$moodle->edit_courses($lr->getClient(),$lr->getSessionKey(),$courses);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
