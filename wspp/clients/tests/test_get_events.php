<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for get_events
* @param int $client
* @param string $sesskey
* @param int $eventtype
* @param string $ownerid
* @param string $owneridfield
* @param int $datetimefrom
* @return  eventRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_events($lr->getClient(),$lr->getSessionKey(),0,'','',0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
