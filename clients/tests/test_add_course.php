<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param courseDatum $course
* @return editCoursesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$course= new courseDatum();
$course->setAction('add');
$course->setId(0);
$course->setCategory(0);
$course->setSortorder(0);
$course->setPassword('');
$course->setFullname('test PP');
$course->setShortname('testpp001');
$course->setIdnumber('testpp001');
$course->setSummary('resumé');
$course->setFormat('');
$course->setShowgrades(0);
$course->setNewsitems(0);
$course->setTeacher('');
$course->setTeachers('');
$course->setStudent('');
$course->setStudents('');
$course->setGuest(0);
$course->setStartdate(0);
$course->setEnrolperiod(0);
$course->setMarker(0);
$course->setMaxbytes(0);
$course->setVisible(0);
$course->setHiddensections(0);
$course->setGroupmode(0);
$course->setGroupmodeforce(0);
$course->setLang('');
$course->setTheme('');
$course->setCost('');
$course->setMetacourse(0);
$res=$moodle->add_course($lr->getClient(),$lr->getSessionKey(),$course);
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
