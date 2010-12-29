<?
/***
Don't forget to adjust the paths to required files
**********************************************/

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

require("../auth.php");
require("../MoodleWS.php");

$moodle= new MoodleWS();

heading ("login IN ");
$lr= $moodle->login(LOGIN,PASSWORD);
print_r_pre($lr);

heading ("get users (username,ppollet)");

print_r_pre($moodle->get_users($lr->client,$lr->sessionkey,array('username','ppollet'),'username'));

$user_2 = new userDatum();
$user_2->action         = 'Add';
$user_2->idnumber       = 123;
$user_2->firstname      = 'first';
$user_2->lastname      = 'last';
$user_2->username       = 'username';
$user_2->password       = 'password';
$user_2->email          = 'email';

$users=new editUsersInput();

$users->users[] = $user_2;
$results  = $moodle->edit_users($lr->client, $lr->sessionkey,$users);
heading ("edit users".print_r($user_2,true));

print_r_pre($results);


heading ("get users (username,ppollet)");

print_r_pre($moodle->get_users($lr->client,$lr->sessionkey,array('username','ppollet'),'username'));


heading ("logout and bye");
$moodle->logout($lr->client,$lr->sessionkey);


function heading ($msg) {
	print "<h2>$msg</h2>\n";
}

function print_r_pre($var) {
	print "<pre>";
        print_r($var);
	print"</pre>"; 
}
?>
