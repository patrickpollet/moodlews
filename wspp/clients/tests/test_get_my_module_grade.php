<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get my grade of an activity/module of a certain type identified by instance id
* @param int $client
* @param string $sesskey
* @param int $id
* @param string $type
* @return  getModuleGradesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_module_grade($lr->getClient(),$lr->getSessionKey(),0,'');
print_r($res);
print($res->getGrades());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
