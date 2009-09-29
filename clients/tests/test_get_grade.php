<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get User Grade
* @param integer $client
* @param string $sesskey
* @param string $userid
* @param string $courseid
* @return float
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_grade($lr->getClient(),$lr->getSessionKey(),'','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
