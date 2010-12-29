<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: Edit Assignment Information
* @param integer $client
* @param string $sesskey
* @param editAssignmentsInput $assignments
* @return  editAssignmentsOutput
*/

$lr=$client->login(LOGIN,PASSWORD);
$assignments= new editAssignmentsInput();
$assignments->setAssignments(array());
$res=$client->edit_assignments($lr->getClient(),$lr->getSessionKey(),$assignments);
print_r($res);
print($res->getAssignments());

$client->logout($lr->getClient(),$lr->getSessionKey());

?>
