<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Forums
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllForumsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_forums($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getForums());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
