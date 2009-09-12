<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get user most recent activities in a Moodle course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @param integer $idlimit
* @return getActivitiesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_activities($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print_r($res);
print($res->getActivities());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
