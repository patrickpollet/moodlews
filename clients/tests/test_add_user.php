<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param userDatum $user
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$user= new userDatum();
$user->setAction('');
$user->setId(0);
$user->setConfirmed(0);
$user->setPolicyagreed(0);
$user->setDeleted(0);
$user->setUsername('');
$user->setAuth('');
$user->setPassword('');
$user->setPasswordmd5('');
$user->setIdnumber('');
$user->setFirstname('');
$user->setLastname('');
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
$user->setMnethostid(0);
$res=$moodle->add_user($lr->getClient(),$lr->getSessionKey(),$user);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
