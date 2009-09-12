<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: returns  user s primary role in a given course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @return integer
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_primaryrole_incourse($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
