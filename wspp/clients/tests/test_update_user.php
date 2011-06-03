<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for update_user
* @param int $client
* @param string $sesskey
* @param userDatum $datum
* @param string $useridfield
* @return  userRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new userDatum();
$datum->setAction('');
$datum->setAddress('');
$datum->setAim('');
$datum->setAuth('');
$datum->setCity('');
$datum->setConfirmed(0);
$datum->setCountry('');
$datum->setDeleted(0);
$datum->setDepartment('');
$datum->setDescription('');
$datum->setEmail('');
$datum->setEmailstop(0);
$datum->setFirstname('');
$datum->setIcq('');
$datum->setId(0);
$datum->setIdnumber('');
$datum->setInstitution('');
$datum->setLang('');
$datum->setLastip('');
$datum->setLastname('');
$datum->setMnethostid(0);
$datum->setMsn('');
$datum->setPassword('');
$datum->setPasswordmd5('');
$datum->setPhone1('');
$datum->setPhone2('');
$datum->setPolicyagreed(0);
$datum->setSkype('');
$datum->setTheme('');
$datum->setTimezone('');
$datum->setUsername('');
$datum->setYahoo('');
$res=$client->update_user($lr->getClient(),$lr->getSessionKey(),$datum,'');
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
