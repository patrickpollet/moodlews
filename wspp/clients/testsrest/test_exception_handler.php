<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for exception_handler
* @param  
* @return  void
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->exception_handler();
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
