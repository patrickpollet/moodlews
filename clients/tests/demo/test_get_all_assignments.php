<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Assignments
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllAssignmentsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_assignments($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
