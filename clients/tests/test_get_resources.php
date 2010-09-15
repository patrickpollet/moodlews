<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get resources in courses
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @return getResourcesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_resources($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getResources());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
