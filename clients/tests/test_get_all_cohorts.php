<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All cohorts
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getCohortsReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_cohorts($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getCohorts());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
