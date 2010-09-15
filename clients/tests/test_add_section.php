<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course section
* @param integer $client
* @param string $sesskey
* @param sectionDatum $section
* @return editSectionsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$section= new sectionDatum();
$section->setAction('');
$section->setId(0);
$section->setCourse(0);
$section->setSection(0);
$section->setSummary('');
$section->setSequence('');
$section->setVisible(0);
$res=$moodle->add_section($lr->getClient(),$lr->getSessionKey(),$section);
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
