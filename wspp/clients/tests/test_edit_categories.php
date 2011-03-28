<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Categories Information
* @param int $client
* @param string $sesskey
* @param editCategoriesInput $categories
* @return  editCategoriesOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$categories= new editCategoriesInput();
$categories->setCategories(array());
$res=$client->edit_categories($lr->getClient(),$lr->getSessionKey(),$categories);
print_r($res);
print($res->getCategories());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
