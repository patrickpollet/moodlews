<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course groups
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_groups_bycourse($lr->getClient(),$lr->getSessionKey(),'pp001','idnumber');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
