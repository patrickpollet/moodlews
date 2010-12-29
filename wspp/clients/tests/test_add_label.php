<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a label
* @param integer $client
* @param string $sesskey
* @param labelDatum $label
* @return  editLabelsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$label= new labelDatum();
$label->setAction('');
$label->setId(0);
$label->setCourse(0);
$label->setName('');
$label->setContent('');
$res=$client->add_label($lr->getClient(),$lr->getSessionKey(),$label);
print_r($res);
print($res->getLabels());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
