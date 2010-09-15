<?php
require_once ('../MoodleWS_NS.php');

$moodle=new MoodleWS_NS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Groups Information
* @param integer $client
* @param string $sesskey
* @param editGroupingsInput $groupings
* @return editGroupingsOutput
*/

$lr=$moodle->login(LOGIN,PASSWORD);
$groupings= new editGroupingsInput();
$groupings->setGroupings(array());
$res=$moodle->edit_groupings($lr->getClient(),$lr->getSessionKey(),$groupings);
print_r($res);
print($res->getGroupings());

$moodle->logout($lr->getClient(),$lr->getSessionKey());

?>
