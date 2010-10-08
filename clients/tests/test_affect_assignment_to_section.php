<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect a section to assignment
* @param integer $client
* @param string $sesskey
* @param integer $assignmentid
* @param integer $sectionid
* @param integer $groupmode
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_assignment_to_section($lr->getClient(),$lr->getSessionKey(),0,0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
