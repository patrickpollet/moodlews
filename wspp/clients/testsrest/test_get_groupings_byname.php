<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_groupings_byname
* @param int $client
* @param string $sesskey
* @param string $groupname
* @param int $courseid
* @return  groupRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_groupings_byname($lr->getClient(),$lr->getSessionKey(),'',0);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
