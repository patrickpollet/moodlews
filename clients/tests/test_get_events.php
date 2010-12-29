<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Moodle s events
* @param integer $client
* @param string $sesskey
* @param integer $eventtype
* @param integer $ownerid
* @return  getEventsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_events($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getEvents());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
