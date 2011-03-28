<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses belonging to category
* @param int $client
* @param string $sesskey
* @param int $categoryid
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_courses_bycategory($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
