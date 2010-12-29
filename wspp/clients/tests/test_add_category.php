<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param integer $client
* @param string $sesskey
* @param categoryDatum $category
* @return  editCategoriesOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
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
$res=$client->add_category($lr->getClient(),$lr->getSessionKey(),$category);
print_r($res);
print($res->getCategories());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
