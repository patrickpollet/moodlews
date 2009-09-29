<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Wikis Information
* @param integer $client
* @param string $sesskey
* @param editWikisInput $wikis
* @return editWikisOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$wikis= new editWikisInput();
$wikis->setWikis(array());
$res=$moodle->edit_wikis($lr->getClient(),$lr->getSessionKey(),$wikis);
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
