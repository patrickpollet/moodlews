<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Databases
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  getAllDatabasesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_databases($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getDatabases());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
