<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit databases Information
* @param integer $client
* @param string $sesskey
* @param editDatabasesInput $databases
* @return editDatabasesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$databases= new editDatabasesInput();
$databases->setDatabases(array());
$res=$moodle->edit_databases($lr->getClient(),$lr->getSessionKey(),$databases);
print_r($res);
print($res->getDatabases());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
