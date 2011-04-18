<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get my grade of an assignmentidentified by instance id
* @param int $client
* @param string $sesskey
* @param int $id
* @return  getModuleGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_assignment_grade($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
