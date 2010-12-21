<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit databases Information
* @param integer $client
* @param string $sesskey
* @param editDatabasesInput $databases
* @return  editDatabasesOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$databases= new editDatabasesInput();
$databases->setDatabases(array());
$res=$client->edit_databases($lr->getClient(),$lr->getSessionKey(),$databases);
print_r($res);
print($res->getDatabases());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
