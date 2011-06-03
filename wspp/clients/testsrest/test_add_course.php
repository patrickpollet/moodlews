<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for add_course
* @param int $client
* @param string $sesskey
* @param courseDatum $coursedatum
* @return  courseRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$coursedatum= new courseDatum();
$coursedatum->setAction('');
$coursedatum->setCategory(0);
$coursedatum->setCost('');
$coursedatum->setEnrolperiod(0);
$coursedatum->setFormat('');
$coursedatum->setFullname('');
$coursedatum->setGroupmode(0);
$coursedatum->setGroupmodeforce(0);
$coursedatum->setGuest(0);
$coursedatum->setHiddensections(0);
$coursedatum->setId(0);
$coursedatum->setIdnumber('');
$coursedatum->setLang('');
$coursedatum->setMarker(0);
$coursedatum->setMaxbytes(0);
$coursedatum->setMetacourse(0);
$coursedatum->setNewsitems(0);
$coursedatum->setPassword('');
$coursedatum->setShortname('');
$coursedatum->setShowgrades(0);
$coursedatum->setSortorder(0);
$coursedatum->setStartdate(0);
$coursedatum->setStudent('');
$coursedatum->setStudents('');
$coursedatum->setSummary('');
$coursedatum->setTeacher('');
$coursedatum->setTeachers('');
$coursedatum->setTheme('');
$coursedatum->setVisible(0);
$res=$client->add_course($lr->getClient(),$lr->getSessionKey(),$coursedatum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
