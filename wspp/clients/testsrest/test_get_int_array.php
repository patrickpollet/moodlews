<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_int_array
* @param int $n
* @return  int[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_int_array($lr->getClient());
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
