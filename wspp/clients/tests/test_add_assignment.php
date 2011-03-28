<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add an assignment
* @param int $client
* @param string $sesskey
* @param assignmentDatum $assignment
* @return  editAssignmentsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
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
$res=$client->add_assignment($lr->getClient(),$lr->getSessionKey(),$assignment);
print_r($res);
print($res->getAssignments());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
