<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Enrol students in a cohort
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $courseidfield
* @param string[] $userids
* @param string $useridfield
* @return  enrolStudentsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$userids=array();
$res=$client->affect_users_to_cohort($lr->getClient(),$lr->getSessionKey(),'','',$userids,'');
print_r($res);
print($res->getStudents());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
