<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS Client Login
* @param string $username
* @param string $password
* @return loginReturn
*/
$res=$moodle->login('','');
print_r($res);
print($res->getClient());
print($res->getSessionkey());


?>
