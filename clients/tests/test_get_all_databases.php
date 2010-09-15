<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Databases
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllDatabasesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_databases($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getDatabases());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
