<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Get Course Information
* @param integer $client
* @param string $sesskey
* @param string $info
* @param integer $courseid
* @return  getCohortsReturn
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_cohort_byidnumber($lr->getClient(),$lr->getSessionKey(),'',0);
print_r($res);
print($res->getCohorts());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
