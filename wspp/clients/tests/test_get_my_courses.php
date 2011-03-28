<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses user identified by id
				is member of
* @param int $client
* @param string $sesskey
* @param int $uid
* @param string $sort
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_courses($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
