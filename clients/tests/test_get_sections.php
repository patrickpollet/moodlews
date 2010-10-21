<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course sections
* @param integer $client
* @param string $sesskey
* @param (getCoursesInput) array of string $courseids
* @param string $idfield
* @return getSectionsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$courseids=array();
$res=$moodle->get_sections($lr->getClient(),$lr->getSessionKey(),$courseids,'');
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
