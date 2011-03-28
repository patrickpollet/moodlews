<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get all Users Grades in one course
* @param int $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return  getGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_course_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
