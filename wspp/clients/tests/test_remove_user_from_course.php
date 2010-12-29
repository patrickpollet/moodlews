<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Remove the role specified of the
				user in the course
* @param integer $client
* @param string $sesskey
* @param integer $userid
* @param integer $courseid
* @param string $rolename
* @return  affectRecord
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->remove_user_from_course($lr->getClient(),$lr->getSessionKey(),0,0,'');
print_r($res);
print($res->getError());
print($res->getStatus());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
