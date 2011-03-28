<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a forum
* @param int $client
* @param string $sesskey
* @param forumDatum $forum
* @return  editForumsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$forum= new forumDatum();
$forum->setAction('');
$forum->setId(0);
$forum->setCourse(0);
$forum->setType('');
$forum->setName('');
$forum->setIntro('');
$forum->setAssessed(0);
$forum->setAssesstimestart(0);
$forum->setAssesstimefinish(0);
$forum->setScale(0);
$forum->setMaxbytes(0);
$forum->setForcesubscribe(0);
$forum->setTrackingtype(0);
$forum->setRsstype(0);
$forum->setRssarticles(0);
$forum->setTimemodified(0);
$forum->setWarnafter(0);
$forum->setBlockafter(0);
$forum->setBlockperiod(0);
$res=$client->add_forum($lr->getClient(),$lr->getSessionKey(),$forum);
print_r($res);
print($res->getForums());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
