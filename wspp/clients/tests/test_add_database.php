<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: add a course category
* @param int $client
* @param string $sesskey
* @param databaseDatum $database
* @return  editDatabasesOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$database= new databaseDatum();
$database->setAction('');
$database->setId(0);
$database->setCourse(0);
$database->setName('');
$database->setIntro('');
$database->setComments(0);
$database->setTimeavailablefrom(0);
$database->setTimeavailableto(0);
$database->setTimeviewfrom(0);
$database->setTimeviewto(0);
$database->setRequiredentries(0);
$database->setRequiredentriestoview(0);
$database->setMaxentries(0);
$database->setRessarticles(0);
$database->setSingletemplate('');
$database->setListtemplate('');
$database->setListtemplateheader('');
$database->setListtemplatefooter('');
$database->setAddtemplatee('');
$database->setRsstemplate('');
$database->setRsstitletemplate('');
$database->setCsstemplate('');
$database->setJstemplate('');
$database->setAsearchtemplate('');
$database->setApproval(0);
$database->setScale(0);
$database->setAssessed(0);
$database->setDefaultsort(0);
$database->setDefaultsortdir(0);
$database->setEditany(0);
$database->setNotification(0);
$res=$client->add_database($lr->getClient(),$lr->getSessionKey(),$database);
print_r($res);
print($res->getDatabases());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
