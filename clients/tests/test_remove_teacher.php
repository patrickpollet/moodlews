<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: remove a teacher in the course
* @param integer $client
* @param string $sesskey
* @param string $value1
* @param string $id1
* @param string $value2
* @param string $id2
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->remove_teacher($lr->getClient(),$lr->getSessionKey(),'','','','');
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
