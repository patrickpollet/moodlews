<?php
require_once ('../classes/mdl_soapserver.php');

$client=new mdl_soapserver();
require_once ('../auth.php');
/**test code for add_category
* @param int $client
* @param string $sesskey
* @param categoryDatum $datum
* @return  categoryRecord[]
*/

$lr=$client->login(LOGIN,PASSWORD);
$datum= new categoryDatum();
$datum->setAction('');
$datum->setDepth(0);
$datum->setDescription('');
$datum->setId(0);
$datum->setName('');
$datum->setParent(0);
$datum->setPath('');
$datum->setSortorder(0);
$datum->setTheme('');
$datum->setVisible(0);
$res=$client->add_category($lr->getClient(),$lr->getSessionKey(),$datum);
print_r($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
