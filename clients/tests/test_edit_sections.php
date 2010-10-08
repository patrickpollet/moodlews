<?php
require_once ('../MoodleWS.php');

$moodle=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit section Information
* @param integer $client
* @param string $sesskey
* @param editSectionsInput $sections
* @return editSectionsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$sections= new editSectionsInput();
$sections->setSections(array());
$res=$moodle->edit_sections($lr->getClient(),$lr->getSessionKey(),$sections);
print_r($res);
print($res->getSections());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
