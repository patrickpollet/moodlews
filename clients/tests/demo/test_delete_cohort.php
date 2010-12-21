<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editCohortsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_cohort($lr->getClient(),$lr->getSessionKey(),'testws','idnumber');
print_r($res);
print($res->getCohorts());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
