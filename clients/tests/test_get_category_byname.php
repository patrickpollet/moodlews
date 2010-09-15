<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get one category defined in Moodle
* @param integer $client
* @param string $sesskey
* @param string $value
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_category_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
