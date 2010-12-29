<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grades in all courses
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return  getGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_user_grades($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
