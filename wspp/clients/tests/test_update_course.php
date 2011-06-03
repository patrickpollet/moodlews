<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for update_course
* @param int $client
* @param string $sesskey
* @param courseDatum $datum
* @param string $courseidfield
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new courseDatum();
$datum->setAction('');
$datum->setCategory(0);
$datum->setCost('');
$datum->setEnrolperiod(0);
$datum->setFormat('');
$datum->setFullname('');
$datum->setGroupmode(0);
$datum->setGroupmodeforce(0);
$datum->setGuest(0);
$datum->setHiddensections(0);
$datum->setId(0);
$datum->setIdnumber('');
$datum->setLang('');
$datum->setMarker(0);
$datum->setMaxbytes(0);
$datum->setMetacourse(0);
$datum->setNewsitems(0);
$datum->setPassword('');
$datum->setShortname('');
$datum->setShowgrades(0);
$datum->setSortorder(0);
$datum->setStartdate(0);
$datum->setStudent('');
$datum->setStudents('');
$datum->setSummary('');
$datum->setTeacher('');
$datum->setTeachers('');
$datum->setTheme('');
$datum->setVisible(0);
$res=$client->update_course($lr->getClient(),$lr->getSessionKey(),$datum,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
