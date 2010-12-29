<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Assignment Information
* @param integer $client
* @param string $sesskey
* @param editAssignmentsInput $assignments
* @return editAssignmentsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$assignments= new editAssignmentsInput();
$assignments->setAssignments(array());
$res=$moodle->edit_assignments($lr->getClient(),$lr->getSessionKey(),$assignments);
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
