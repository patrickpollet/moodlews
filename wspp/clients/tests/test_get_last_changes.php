<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get last changes to a Moodle s
				course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $idfield
* @param integer $limit
* @return  getLastChangesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_last_changes($lr->getClient(),$lr->getSessionKey(),'','',0);
print_r($res);
print($res->getChanges());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
