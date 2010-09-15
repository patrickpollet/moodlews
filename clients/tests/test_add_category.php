<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param categoryDatum $category
* @return editCategoriesOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$category= new categoryDatum();
$category->setAction('');
$category->setId(0);
$category->setName('');
$category->setDescription('');
$category->setParent(0);
$category->setSortorder(0);
$category->setVisible(0);
$category->setDepth(0);
$category->setPath('');
$category->setTheme('');
$res=$moodle->add_category($lr->getClient(),$lr->getSessionKey(),$category);
print_r($res);
print($res->getCategories());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
