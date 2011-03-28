<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Label Information
* @param int $client
* @param string $sesskey
* @param editLabelsInput $labels
* @return  editLabelsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$labels= new editLabelsInput();
$labels->setLabels(array());
$res=$client->edit_labels($lr->getClient(),$lr->getSessionKey(),$labels);
print_r($res);
print($res->getLabels());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
