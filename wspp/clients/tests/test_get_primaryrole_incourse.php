<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: returns user s primary role in a
				given course
* @param int $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_primaryrole_incourse($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
