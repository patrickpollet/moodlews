<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Moodle course categories
* @param int $client
* @param string $sesskey
* @return  getCategoriesReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_categories($lr->getClient(),$lr->getSessionKey());
print_r($res);
print($res->getCategories());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
