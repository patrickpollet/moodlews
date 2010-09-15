<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Categories Information
* @param integer $client
* @param string $sesskey
* @param editCategoriesInput $categories
* @return editCategoriesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$categories= new editCategoriesInput();
$categories->setCategories(array());
$res=$moodle->edit_categories($lr->getClient(),$lr->getSessionKey(),$categories);
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
