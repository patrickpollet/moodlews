<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Groups Information
* @param int $client
* @param string $sesskey
* @param editGroupingsInput $groupings
* @return  editGroupingsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$groupings= new editGroupingsInput();
$groupings->setGroupings(array());
$res=$client->edit_groupings($lr->getClient(),$lr->getSessionKey(),$groupings);
print_r($res);
print($res->getGroupings());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
