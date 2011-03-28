<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All roles defined in Moodle
* @param int $client
* @param string $sesskey
* @return  getRolesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_roles($lr->getClient(),$lr->getSessionKey());
print_r($res);
print($res->getRoles());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
