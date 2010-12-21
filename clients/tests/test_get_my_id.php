<?php
require_once ('../classes/MoodleWS.php');

$client=new MoodleWS();
require_once ('../auth.php');
/**test code for MoodleWS: get current user Moodle internal id
				(helper)
* @param integer $client
* @param string $sesskey
* @return  integer
*/

$lr=$client->login(LOGIN,PASSWORD);
$res=$client->get_my_id($lr->getClient(),$lr->getSessionKey());
print($res);
$client->logout($lr->getClient(),$lr->getSessionKey());

?>
