<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user group in course
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_group($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
