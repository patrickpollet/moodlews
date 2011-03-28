<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param int $client
* @param string $sesskey
* @param string $info
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_course_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
