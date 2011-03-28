<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Courses current user identified
				by idnumber is member of
* @param int $client
* @param string $sesskey
* @param string $uinfo
* @param string $sort
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_courses_byidnumber($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
