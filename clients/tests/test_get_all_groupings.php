<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All groupings
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllGroupingsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_groupings($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
