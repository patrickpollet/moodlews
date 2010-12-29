<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get one category defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_category_byid($lr->getClient(),$lr->getSessionKey(),'2');
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
