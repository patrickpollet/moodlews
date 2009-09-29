<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: assign-unassign user as a member of a group in course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $userid
* @param integer $atigroup
* @param boolean $assign
* @return boolean
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->set_group_member($lr->getClient(),$lr->getSessionKey(),'','',0,false);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
