<?
/**
* some useful functions for test clients in PHP
* 
*/




function heading ($msg) {
	global $_SERVER;
	if (isset($_SERVER['REMOTE_ADDR'])) 
		print "<h2>$msg</h2>";
	else
		print $msg."\n";
}

function print_r_pre($var) {
	global $_SERVER;
        if (isset($_SERVER['REMOTE_ADDR'])) {
		print "<pre>";
        	print_r($var);
		print"</pre>";
	} else
		print_r($var); 
}

function print_xml ($var) {
	global $_SERVER;
        if (isset($_SERVER['REMOTE_ADDR']))
		print (htmlspecialchars($var));
	else
		print $var;
}
function print_trace ($moodle) {
	// ces 4 mÃ©thods renvoient une chaine non vide si trace a ÃtÃ activÃ© dans les options
	heading ("getLastRequestHeaders");
	print ($moodle->client->__getLastRequestHeaders());
	heading ("getLastRequest");
	print_xml ($moodle->client->__getLastRequest());
	heading ("getLastResponseHeaders");
	print ($moodle->client->__getLastResponseHeaders());
	heading ("getLastResponseHeaders");
	print_xml ($moodle->client->__getLastResponse());
}


?>
