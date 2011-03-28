<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get one category defined in Moodle
* @param int $client
* @param string $sesskey
* @param string $value
* @return  getCategoriesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_category_byname($lr->getClient(),$lr->getSessionKey(),'');
print_r($res);
print($res->getCategories());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
