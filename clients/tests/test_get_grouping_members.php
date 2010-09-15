<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get users members of a grouping in
				course
* @param integer $client
* @param string $sesskey
* @param integer $groupid
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_grouping_members($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
