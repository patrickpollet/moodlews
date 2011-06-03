<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for count_activities
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $courseid
* @param string $courseidfield
* @param int $limit
* @return  int
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->count_activities($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
