<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for has_role_incourse
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $courseid
* @param string $courseidfield
* @param int $roleid
* @return  boolean
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->has_role_incourse($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
