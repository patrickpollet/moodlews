<?php // $Id: ws_course_xls.php,v 1.0 2007/04/28 03:45:49 PP Exp $

/*******************************
example of a MoodleWS client in PHP5 with nuSOAP.
this demo code is meant to be run as it
from the directory $CFG->wwwroot/wspp/clients.


To use this code  you
MUST run on THAT machine (including the direcory on server) 
the supplied utility script
wsdl2php.php against your Moodle server as follow

wsdl2php http://yourmoodle/wspp/wsdl_pp.php nusoap

to generate the MoodleWS_NS required file including a MoodleWS_NS class
and all support classes for returned datatypes.

Running that utility several times is harmless. 


If you modify server code and wsdl to add new remote calls
you MUST rerun the wsdl2php utility on every clients,
including this demo directory to keep them in sync.

Don't forget to adjust the paths to required files  

For some reason, nuSoap keep the returned arrays as arrays, whereas
PHP5 SoapClient convert them to StdClasses ...
So code of nusoap using clients is different !!!
$res->error MUST be changed to $res[error] ...
$res->users MUST be changed to $res[users] ...

Also for "big returns",  default allocated memory is likely to be exhausted
(16Mb is not enough  to parse a 200 users array (220Kb) returned !!! )  
see set_memory_limit attop this script ... strangely, the memory problem
does not happen with basic clients not using class MoodleWS_NS 
(see ws-test.php for get_users_bycourse with courseid=2 and roleid=5) 
What's wrong ? 


*******************************/

// Return in CSV format the users within a given course
// having the given role
// using MoodleWS services 
// Current user role (as teacher of that course) is tested and required
// by the Web Service call get_users_bycourse.

	
require_once('MoodleWS_NS.php');    // class using nusoap ; adjust on remote clients
require("auth.php");                // edit & rename auth.php.dist

//NUSOAP !!!!
function set_memory_limit($new_limit) {

        /* Check their PHP Vars to make sure we're cool here */
        // Up the memory
        $current_memory = ini_get('memory_limit');
        $current_memory = substr($current_memory,0,strlen($current_memory)-1);
        if ($current_memory < $new_limit) {
                $php_memory = $new_limit . "M";
                ini_set (memory_limit, "$php_memory");
                unset($php_memory);
        }

} // set_memory_limit


set_memory_limit(48);  

/*  TESTS in command line */ 
if( $_SERVER['argc'] == 3 ) {  // php ws_course_xls courseid roleid 
    $courseid= $_SERVER['argv'][1];
    $roleid= $_SERVER['argv'][2];
} else { //http://yourmoodle/wspp/clients/ws_course_xls.php?courseid=xx&roleid=zz
    $courseid = $_GET['courseid'];
    $roleid = $_GET['roleid'];   // Role , 0= all roles
}

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

$moodle= new MoodleWS_NS();

try {
	$lr= $moodle->login(LOGIN,PASSWORD);
//	print_r($lr);

	$users=$moodle->get_users_bycourse($lr[client],$lr[sessionkey],$courseid,'id',$roleid);
}
catch (Exception $e) {
	$user=array();
	$user[error]=$e->getMessage();
	$users[users][0]=$user;
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
foreach ($users[users] as $user) {
	if (!$user[error]) {
		foreach($fields as $field) {
			print($user[$field]."\t");
		}
		print("\n");
	}else {
		print("$user[error]\n");
	}
}
$moodle->logout($lr->client,$lr->sessionkey);


