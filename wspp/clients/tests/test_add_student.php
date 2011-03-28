<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a student in the course
* @param int $client
* @param string $sesskey
* @param string $value1
* @param string $id1
* @param string $value2
* @param string $id2
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->add_student($lr->getClient(),$lr->getSessionKey(),'','','','');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
