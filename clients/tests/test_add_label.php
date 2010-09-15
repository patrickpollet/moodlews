<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add a label
* @param integer $client
* @param string $sesskey
* @param labelDatum $label
* @return editLabelsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$label= new labelDatum();
$label->setAction('');
$label->setId(0);
$label->setCourse(0);
$label->setName('');
$label->setContent('');
$res=$moodle->add_label($lr->getClient(),$lr->getSessionKey(),$label);
print_r($res);
print($res->getLabels());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
