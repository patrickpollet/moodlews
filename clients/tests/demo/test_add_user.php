<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add on course
* @param integer $client
* @param string $sesskey
* @param userDatum $user
* @return editUsersOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$user= new userDatum();
$user->setUsername('toto1');
$user->setAuth('manual');
$user->setPassword('toto123');
$user->setIdnumber('toto1');
$user->setFirstname('toto');
$user->setLastname('toto');
$user->setEmail('toto1@patrickpollet.net');
$user->setInstitution('insa');
$user->setDepartment('pc');
$user->setAddress('ici');
$user->setCity('lyon');
$user->setCountry('fr');
$res=$moodle->add_user($lr->getClient(),$lr->getSessionKey(),$user);
print_r($res);
print($res->getUsers());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
