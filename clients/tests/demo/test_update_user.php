<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param userDatum $user
* @param string $idfield
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$user= new userDatum();
//$user->setAction('');
//$user->setId(0);
$user->setConfirmed(0);
$user->setPolicyagreed(0);
$user->setDeleted(0);
$user->setUsername('toto');
$user->setFirstname('prénom de toto');
$user->setLastname('nom de toto');
$user->setEmail('');
$user->setEmailstop(0);
$user->setIcq('');
$user->setSkype('');
$user->setYahoo('');
$user->setAim('');
$user->setMsn('');
$user->setPhone1('');
$user->setPhone2('');
$user->setInstitution('');
$user->setDepartment('');
$user->setAddress('');
$user->setCity('');
$user->setCountry('');
$user->setLang('');
$user->setTimezone(0);
$user->setLastip('');
$user->setTheme('');
$user->setDescription('');
$res=$moodle->update_user($lr->getClient(),$lr->getSessionKey(),$user,'username');
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
