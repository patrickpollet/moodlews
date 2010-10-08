<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllWikisReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_wikis($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getWikis());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
