<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses user identified by id
				is member of
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @param string $sort
* @return getCoursesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_courses($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getCourses());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
