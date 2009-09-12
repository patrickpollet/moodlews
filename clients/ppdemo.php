<?
/***************************************
example of a MoodleWS client in PHP5.
this demo code is meant to be run as it
from the directory $CFG->wwwroot/wspp/clients.

To use this code from another machine you
MUST run on THAT machine the supplied utility script
wsdl2php.php against your Moodle server
to generate the MoodleWs class
and all support classes for returned datatypes.
eg: php wsdl2php.php http://youmoodle/wspp/wsdl_pp.php.


Running that utility several times is harmless.
If you modify server code and wsdl to add new remote calls
you MUST rerun the wsdl2php utilty to keep your clients in sync.


Don't forget to adjust the paths to required files
**********************************************/

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

require("auth.php");
require("MoodleWS.php");

$moodle= new MoodleWS();

heading ("login IN ");
$lr= $moodle->login(LOGIN,PASSWORD);
print_r_pre($lr);




print_r_pre($moodle->get_last_changes($lr->client,$lr->sessionkey,2,'id',5));


heading ("get courses by category 2");

print_r_pre($moodle->get_courses_bycategory($lr->client,$lr->sessionkey,2));

//die;

heading ("get roles");

print_r_pre($moodle->get_roles($lr->client,$lr->sessionkey));


heading ("get categories");

print_r_pre($moodle->get_categories($lr->client,$lr->sessionkey));


heading ("get my courses (as current user)");

print_r_pre($moodle->get_my_courses($lr->client,$lr->sessionkey));

heading ("get my courses (guest)");

print_r_pre($moodle->get_my_courses($lr->client,$lr->sessionkey,1));


heading ("get users (ppollet,pguy,toto)");

print_r_pre($moodle->get_users($lr->client,$lr->sessionkey,array('ppollet','pguy','toto'),'username'));



heading ("get courses ('C2I_101','1PC_PASSINFO','unknown']");

//TODO retourne le cours 0 si 'idnumber' est absent

print_r_pre($moodle->get_courses($lr->client,$lr->sessionkey,array('C2I_101','1PC_PASSINFO','unknown'),'idnumber'));

heading ("get course C2I_101");

print_r_pre($moodle->get_course($lr->client,$lr->sessionkey,'C2I_101'));

heading ("get course by id 2 ");

print_r_pre($moodle->get_course_byid($lr->client,$lr->sessionkey,2));

heading ("get course by id -1 unknown ");

print_r_pre($moodle->get_course_byid($lr->client,$lr->sessionkey,-1));



heading ("get user astrid");

print_r_pre($moodle->get_user($lr->client,$lr->sessionkey,'astrid','username'));



heading ("get users by course id=2 role =0, any ");

$myc=$moodle->get_users_bycourse($lr->client,$lr->sessionkey,2,'id',0);

print (count($myc->users));
print(" users found <br />\n");

heading ("get users by course id=2 role =3, teachers");

$myc=$moodle->get_users_bycourse($lr->client,$lr->sessionkey,2,'id',3);

print(count($myc->users));
print(" users found <br />\n");


heading ("get users by course id=2 role =5, students");

$myc=$moodle->get_users_bycourse($lr->client,$lr->sessionkey,2,'id',5);

print(count($myc->users));
print(" users found <br />\n");

heading ("get user by name  pguy");


print_r_pre($moodle->get_user_byusername($lr->client,$lr->sessionkey,'pguy'));

heading ("get user by id 77");

print_r_pre($moodle->get_user_byid($lr->client,$lr->sessionkey,77));

heading ("get user  by id -1 (unknown)");

print_r_pre($moodle->get_user_byid($lr->client,$lr->sessionkey,-1));

heading ("get teachers  by course id =38 (unknown)");

print_r_pre($moodle->get_teachers($lr->client,$lr->sessionkey,38,'id'));

//course 2
print_r_pre($moodle->get_activities($lr->client,$lr->sessionkey,"ppollet","username",2,"id",10));

//all site
print_r_pre($moodle->get_activities($lr->client,$lr->sessionkey,"ppollet","username",'','',10));

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
