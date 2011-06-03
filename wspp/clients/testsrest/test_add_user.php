<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for add_user
* @param int $client
* @param string $sesskey
* @param userDatum $userdatum
* @return  userRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$userdatum= new userDatum();
$userdatum->setAction('');
$userdatum->setAddress('');
$userdatum->setAim('');
$userdatum->setAuth('');
$userdatum->setCity('');
$userdatum->setConfirmed(0);
$userdatum->setCountry('');
$userdatum->setDeleted(0);
$userdatum->setDepartment('');
$userdatum->setDescription('');
$userdatum->setEmail('');
$userdatum->setEmailstop(0);
$userdatum->setFirstname('');
$userdatum->setIcq('');
$userdatum->setId(0);
$userdatum->setIdnumber('');
$userdatum->setInstitution('');
$userdatum->setLang('');
$userdatum->setLastip('');
$userdatum->setLastname('');
$userdatum->setMnethostid(0);
$userdatum->setMsn('');
$userdatum->setPassword('');
$userdatum->setPasswordmd5('');
$userdatum->setPhone1('');
$userdatum->setPhone2('');
$userdatum->setPolicyagreed(0);
$userdatum->setSkype('');
$userdatum->setTheme('');
$userdatum->setTimezone('');
$userdatum->setUsername('');
$userdatum->setYahoo('');
$res=$client->add_user($lr->getClient(),$lr->getSessionKey(),$userdatum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
