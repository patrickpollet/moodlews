<?
/***************************************
example of a MoodleWS client in PHP5.
with SoapClient trace enabled
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

$moodle= new MoodleWS("http://localhost/moodle/wspp/wsdl_pp.php",
                       null,
                       array('trace'=>1));

heading ("login IN ");
$lr= $moodle->login(LOGIN,PASSWORD);
print_r_pre($lr,$moodle);

print_r_pre($moodle->get_sections($lr->client,$lr->sessionkey,array('38'),'id'),$moodle);
$moodle->logout($lr->client,$lr->sessionkey,$moodle);

function heading ($msg) {
	print "<h2>$msg</h2>\n";
}

/**
* print something in <pre> tags for better viewing on a browser
* @param $var any type : the info to dump
* @param $client : an instance of MoodleWS  contructed with option trace=1
*        thus allowing a call to debug functions __getLast* 
*/

function print_r_pre($var,$client=null) {
	print "<pre>";
        print_r($var);
	if ($client) {
        	print "<br>\n";
        	echo "REQUEST HEADERS:\n" . $client->client->__getLastRequestHeaders() . "<br>\n";
        	echo "REQUEST:\n" . $client->client->__getLastRequest() . "<br>\n";
        	echo "RESPONSE HEADERS:\n" . $client->client->__getLastResponseHeaders() . "<br>\n";
        	echo "RESPONSE:\n" . $client->client->__getLastResponse() . "<br>\n";
	}
	print"</pre>"; 
}
?>
