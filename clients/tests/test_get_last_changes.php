<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get last changes to a Moodle s course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @param integer $limit
* @return getLastChangesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_last_changes($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
print($res->getChanges());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
