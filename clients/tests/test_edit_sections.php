<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit section Information
* @param integer $client
* @param string $sesskey
* @param editSectionsInput $sections
* @return  editSectionsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$sections= new editSectionsInput();
$sections->setSections(array());
$res=$client->edit_sections($lr->getClient(),$lr->getSessionKey(),$sections);
print_r($res);
print($res->getSections());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
