<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: count user most recent activities
				in a Moodle course
* @param integer $client
* @param string $sesskey
* @param string $value1
* @param string $id1
* @param string $value2
* @param string $id2
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->count_activities($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
