<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_groups_byname($lr->getClient(),$lr->getSessionKey(),'',0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
