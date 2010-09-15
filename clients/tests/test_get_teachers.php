<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get course teachers
* @param integer $client
* @param string $sesskey
* @param string $value
* @param string $id
* @return getUsersReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_teachers($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
