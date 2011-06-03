<?php
require_once ('../classes/mdl_soapserverrest.php');

$client=new mdl_soapserverrest();
require_once ('../auth.php');
/**test code for add_forum
* @param int $client
* @param string $sesskey
* @param forumDatum $datum
* @return  forumRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new forumDatum();
$datum->setAction('');
$datum->setAssessed(0);
$datum->setAssesstimefinish(0);
$datum->setAssesstimestart(0);
$datum->setBlockafter(0);
$datum->setBlockperiod(0);
$datum->setCourse(0);
$datum->setForcesubscribe(0);
$datum->setId(0);
$datum->setIntro('');
$datum->setMaxbytes(0);
$datum->setName('');
$datum->setRssarticles(0);
$datum->setRsstype(0);
$datum->setScale(0);
$datum->setTimemodified(0);
$datum->setTrackingtype(0);
$datum->setType('');
$datum->setWarnafter(0);
$res=$client->add_forum($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
