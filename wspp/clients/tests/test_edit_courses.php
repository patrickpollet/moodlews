<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Courses Information
* @param int $client
* @param string $sesskey
* @param editCoursesInput $courses
* @return  editCoursesOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$courses= new editCoursesInput();
$courses->setCourses(array());
$res=$client->edit_courses($lr->getClient(),$lr->getSessionKey(),$courses);
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
