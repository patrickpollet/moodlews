<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param int $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @return  getCoursesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_course($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCourses());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
