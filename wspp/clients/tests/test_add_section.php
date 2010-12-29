<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course section
* @param integer $client
* @param string $sesskey
* @param sectionDatum $section
* @return  editSectionsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$section= new sectionDatum();
$section->setAction('');
$section->setId(0);
$section->setCourse(0);
$section->setSection(0);
$section->setSummary('');
$section->setSequence('');
$section->setVisible(0);
$res=$client->add_section($lr->getClient(),$lr->getSessionKey(),$section);
print_r($res);
print($res->getSections());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
