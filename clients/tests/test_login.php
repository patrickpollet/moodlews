<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
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
