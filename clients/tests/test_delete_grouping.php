<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->delete_grouping($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
