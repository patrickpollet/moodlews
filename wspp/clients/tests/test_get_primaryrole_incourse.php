<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_primaryrole_incourse
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $courseid
* @param string $courseidfield
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_primaryrole_incourse($lr->getClient(),$lr->getSessionKey(),'','','','');
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
