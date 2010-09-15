<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Get All Pages Wikis
* @param integer $client
* @param string $sesskey
* @param string $fieldname
* @param string $fieldvalue
* @return getAllPagesWikiReturn
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$res=$moodle->get_all_pagesWiki($lr->getClient(),$lr->getSessionKey(),'','');
print_r($res);
print($res->getPageswiki());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
