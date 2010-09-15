<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: get current user Moodle internal id
				(helper)
* @param integer $client
* @param string $sesskey
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_my_id($lr->getClient(),$lr->getSessionKey());
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
