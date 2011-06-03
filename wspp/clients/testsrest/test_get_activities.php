<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_activities
* @param int $client
* @param string $sesskey
* @param string $userid
* @param string $useridfield
* @param string $courseid
* @param string $courseidfield
* @param int $limit
* @return  activityRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_activities($lr->getClient(),$lr->getSessionKey(),'','','','',0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
