<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for get_boolean_array
* @param  
* @return  boolean[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_boolean_array();
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
