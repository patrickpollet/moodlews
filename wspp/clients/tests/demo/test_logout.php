<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Client Logout
* @param integer $client
* @param string $sesskey
* @return boolean
*/
$res=$moodle->logout(0,'');
print($res);

?>
