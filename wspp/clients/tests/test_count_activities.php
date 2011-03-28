<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: count user most recent activities
				in a Moodle course
* @param int $client
* @param string $sesskey
* @param string $value1
* @param string $id1
* @param string $value2
* @param string $id2
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->count_activities($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
