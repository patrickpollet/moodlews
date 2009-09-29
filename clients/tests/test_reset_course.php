<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: performs a moodle reset of a course
* @param integer $client
* @param string $sesskey
* @param string $courseid
* @param string $newstartdate
* @param boolean $allincat
* @param boolean $stuonly
* @return boolean
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->reset_course($lr->getClient(),$lr->getSessionKey(),'','',false,false);
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
