<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add an assignment
* @param integer $client
* @param string $sesskey
* @param assignmentDatum $assignment
* @return editAssignmentsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$assignment= new assignmentDatum();
$assignment->setAction('');
$assignment->setId(0);
$assignment->setCourse(0);
$assignment->setName('');
$assignment->setDescription('');
$assignment->setFormat(0);
$assignment->setAssignmenttype('');
$assignment->setResubmit(0);
$assignment->setPreventlate(0);
$assignment->setEmailteachers(0);
$assignment->setVar1(0);
$assignment->setVar2(0);
$assignment->setVar3(0);
$assignment->setVar4(0);
$assignment->setVar5(0);
$assignment->setMaxbytes(0);
$assignment->setTimedue(0);
$assignment->setTimeavailable(0);
$assignment->setGrade(0);
$assignment->setTimemodified(0);
$res=$moodle->add_assignment($lr->getClient(),$lr->getSessionKey(),$assignment);
print_r($res);
print($res->getAssignments());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
