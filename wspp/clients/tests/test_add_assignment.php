<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_assignment
* @param int $client
* @param string $sesskey
* @param assignmentDatum $datum
* @return  assignmentRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new assignmentDatum();
$datum->setAction('');
$datum->setAssignmenttype('');
$datum->setCourse(0);
$datum->setDescription('');
$datum->setEmailteachers(0);
$datum->setFormat(0);
$datum->setGrade(0);
$datum->setId(0);
$datum->setMaxbytes(0);
$datum->setName('');
$datum->setPreventlate(0);
$datum->setResubmit(0);
$datum->setTimeavailable(0);
$datum->setTimedue(0);
$datum->setTimemodified(0);
$datum->setVar1(0);
$datum->setVar2(0);
$datum->setVar3(0);
$datum->setVar4(0);
$datum->setVar5(0);
$res=$client->add_assignment($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
