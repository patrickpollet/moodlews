<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Moodle s events
* @param integer $client
* @param string $sesskey
* @param integer $eventtype
* @param integer $ownerid
* @return getEventsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_events($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getEvents());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
