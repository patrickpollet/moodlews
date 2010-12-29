<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Label Information
* @param integer $client
* @param string $sesskey
* @param editLabelsInput $labels
* @return editLabelsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$labels= new editLabelsInput();
$labels->setLabels(array());
$res=$moodle->edit_labels($lr->getClient(),$lr->getSessionKey(),$labels);
print_r($res);
print($res->getLabels());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
