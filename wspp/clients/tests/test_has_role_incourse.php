<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: check if user has a given role in a
				given course
* @param integer $client
* @param string $sesskey
* @param string $iduser
* @param string $iduserfield
* @param string $idcourse
* @param string $idcoursefield
* @param integer $idrole
* @return  boolean
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->has_role_incourse($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
