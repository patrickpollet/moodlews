<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect user to the course
* @param int $client
* @param string $sesskey
* @param int $userid
* @param int $courseid
* @param string $rolename
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->affect_user_to_course($lr->getClient(),$lr->getSessionKey(),0,0,'');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
