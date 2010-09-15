<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Moodle course categories
* @param integer $client
* @param string $sesskey
* @return getCategoriesReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_categories($lr->getClient(),$lr->getSessionKey());
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
