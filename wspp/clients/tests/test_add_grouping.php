<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param int $client
* @param string $sesskey
* @param groupingDatum $grouping
* @return  editGroupingsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$grouping= new groupingDatum();
$grouping->setAction('');
$grouping->setId(0);
$grouping->setCourseid(0);
$grouping->setName('');
$grouping->setDescription('');
$res=$client->add_grouping($lr->getClient(),$lr->getSessionKey(),$grouping);
print_r($res);
print($res->getGroupings());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
