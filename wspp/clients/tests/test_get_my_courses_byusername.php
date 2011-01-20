<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses current user identified
				by username is member of
* @param integer $client
* @param string $sesskey
* @param string $uinfo
* @param string $sort
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_courses_byusername($lr->getClient(),$lr->getSessionKey(),'ppollet','');
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
