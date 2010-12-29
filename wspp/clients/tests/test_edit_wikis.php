<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Wikis Information
* @param integer $client
* @param string $sesskey
* @param editWikisInput $wikis
* @return  editWikisOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$wikis= new editWikisInput();
$wikis->setWikis(array());
$res=$client->edit_wikis($lr->getClient(),$lr->getSessionKey(),$wikis);
print_r($res);
print($res->getWikis());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
