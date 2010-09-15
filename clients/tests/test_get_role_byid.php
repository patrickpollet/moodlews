<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get one role defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getRolesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_role_byid($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getRoles());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
