<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user group in course
* @param integer $client
* @param string $sesskey
* @param integer $uid
* @param integer $courseid
* @return getGroupsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_group($lr->getClient(),$lr->getSessionKey(),'toto','username',4,'id');
print_r($res);
print($res->getGroups());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
