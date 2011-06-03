<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_float_array
* @param float $n
* @return  float[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_float_array($lr->getClient());
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
