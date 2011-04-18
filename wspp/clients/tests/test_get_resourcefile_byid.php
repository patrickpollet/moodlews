<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get a resource file by it instance id
* @param int $client
* @param string $sesskey
* @param int $resourceid
* @return  fileRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_resourcefile_byid($lr->getClient(),$lr->getSessionKey(),0);
print_r($res);
print($res->getFileurl());
print($res->getFilename());
print($res->getFilepath());
print($res->getFilesize());
print($res->getFilecontent());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
