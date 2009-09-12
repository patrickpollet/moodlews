<?

/**
* test 001 : lecture des propriétés d'utilisateurs
* en mode normal
*/


ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

require("../auth.php");
require("../MoodleWS.php");
require("utils.php");

$moodle= new MoodleWS();

heading ("login IN ");
$lr= $moodle->login(LOGIN,PASSWORD);
print_r_pre($lr);

$users=array('ofranco','ppollet','inconnu');
heading ("get_users:\n ".print_r($users,true));

$res=$moodle->get_users($lr->client,$lr->sessionkey,$users,'username');
print_r_pre($res);

foreach ($res->users as $user) {
	if ($user->error)
		print ($user->error."\n");
	else 
		print ($user->email."\n");
}


//print_trace($moodle);
heading ("logout");
$moodle->logout($lr->client,$lr->sessionkey);

?>
