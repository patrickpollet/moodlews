<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return  getAllWikisReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_all_wikis($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getWikis());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
