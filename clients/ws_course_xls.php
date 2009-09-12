<?php // $Id: ws_course_xls.php,v 1.0 2007/04/28 03:45:49 PP Exp $

/*******************************
example of a MoodleWS client in PHP5.
this demo code is meant to be run as it
from the directory $CFG->wwwroot/wspp/clients.


To use this code  you
MUST run on THAT machine (including this directory on server)
the supplied utility script
wsdl2php.php against your Moodle server as follow
to generate the MoodleWs class
and all support classes for returned datatypes.

eg: php wsdl2php.php http://youmoodle/wspp/wsdl_pp.php.

Running that utility several times is harmless.
 
If you modify server code and wsdl to add new remote calls
you MUST rerun the wsdl2php utility on every client,
including this demo directory, to keep them in sync.
  

Don't forget to adjust the paths to required files  
*******************************/

// Return in CSV format the users within a given course
// having the given role
// using MoodleWS services 
// Current user role (as teacher of that course) is tested and required
// by the Web Service call get_users_bycourse.

	
require_once('MoodleWS.php');    // adjust on remote clients
require("auth.php");             // see example in wspp/clients directory

/*  TESTS in command line */ 
if( $_SERVER['argc'] == 3 ) {  // php ws_course_xls courseid roleid 
    $courseid= $_SERVER['argv'][1];
    $roleid= $_SERVER['argv'][2];
} else { //http://yourmoodle/wspp/clients/ws_course_xls.php?courseid=xx&roleid=zz
    $courseid = $_GET['courseid'];
    $roleid = $_GET['roleid'];   // Role , 0= all roles
}

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

$moodle= new MoodleWS();

try {
	$lr= $moodle->login(LOGIN,PASSWORD);
//	print_r($lr);

	$users=$moodle->get_users_bycourse($lr->client,$lr->sessionkey,$courseid,'id',$roleid);
}
catch (Exception $e) {
	$user=new StdClass;
	$user->error=$e->getMessage();
	$users->users[0]=$user;
}
// print_r($users);

$fields=array('id','lastname','firstname','idnumber','department','institution','address','email');

if(!$roleid) {
        $strFic=$courseid."_all.csv";
    } else {
        $strFic=$courseid."_".$roleid.".csv";
}


header("content-type: application/vnd.ms-excel");
header("content-disposition: attachment; filename=$strFic");

echo (implode("\t",$fields)."\n");
foreach ($users->users as $user) {
	if (!$user->error) {
		foreach($fields as $field) {
			print($user->$field."\t");
		}
		print("\n");
	}else {
		print("$user->error\n");
	}
}
$moodle->logout($lr->client,$lr->sessionkey);


