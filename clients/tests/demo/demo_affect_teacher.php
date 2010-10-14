<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All roles defined in Moodle
* @param integer $client
* @param string $sesskey
* @return getRolesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);

//1) get the userid if not known by 

$res=$moodle->get_user($lr->getClient(),$lr->getSessionKey(),'toto','username');

//print_r($res);

$users=$res->getUsers();
$userid=$users[0]->id;

//2) get the courseid if not known by 

$res=$moodle->get_course($lr->getClient(),$lr->getSessionKey(),'pp001','idnumber');

print_r($res);
$courseid=$res->courses[0]->id;

if ($courseid && $userid) {
//and call 
print ('uid='.$userid.' cid='.$courseid."\n");
$res=$moodle->affect_user_to_course ($lr->getClient(),$lr->getSessionKey(),$userid,$courseid,'editingteacher');
print_r($res);
} else 
print "user or course not found";

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
