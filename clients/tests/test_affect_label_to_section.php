<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Affect Label to Section
* @param integer $client
* @param string $sesskey
* @param integer $labelid
* @param integer $sectionid
* @return affectRecord
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->affect_label_to_section($lr->getClient(),$lr->getSessionKey(),0,0);
print_r($res);
print($res->getError());
print($res->getStatus());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
