<?php
// $Id: service_pp2.php 428 2010-10-21 13:45:47Z ppollet $

/**
 * PHP5 only SOAP server for Moodle
 * @package Web Services
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr>
 */

/*revisions
 1.5.1 :added a basic support for enumeration of functions (a la nusoap)
*/



// get Moodle site config infos
require_once ('../config.php');

//DO not mess XML outputs with some php strict of deprecated warnings !!!!
ini_set('display_errors', 0);

$wsfunction = optional_param('wsfunction', '', PARAM_ALPHAEXT);  // letters+underscore
$wsformatout =optional_param('wsformatout', '', PARAM_ALPHA);

$CFG->wsdl_simplified = true;  // for both SOAP and REST

if ($wsfunction && $wsformatout) {
	// REST service 
	//print_r($_REQUEST);
	unset($_REQUEST['wsfunction']);
	unset($_REQUEST['wsformatout']);
	//echo "1";
	require_once ('mdl_restserver.class.php');
	//echo "2";
	$server=new mdl_restserver($wsformatout);
	$server->handle($wsfunction);
	
	die();


} else {

	// SOAP service class

	//$CFG->ws_uselocalwsdl=0;

	require ('mdl_soapserver.class.php');

	// use Internet to fetch operations & types
	// so as to be in sync with clients
	if (empty ($CFG->ws_uselocalwsdl)) {
		$wsdl = $CFG->wwwroot . "/wspp/wsdl_pp2.php";
	} else {
		//some versions of PHP 5 have a problem reading 'big wsdls over the Internet'
		// but not from a 'locally copied' wsdl file
		// see http://bugs.php.net/bug.php?id=48216
		// so we created the appropriate wsdl file in moodle's data dir (in call to wsdl.php) and use it also here'
		$wsdl = $CFG->dataroot . '/wspp/moodlews2.wsdl';
	}

	$server = new SoapServer($wsdl);

	// all function of this class are calleable if cited in wsdl_pp file
	$server->setClass("mdl_soapserver");

	if ($_SERVER["REQUEST_METHOD"] == "POST")
		$server->handle();
	/*************/
	else {
		echo "Ce serveur SOAP peut g&eacute;rer les fonctions suivantes : <br/>";
		$functions = $server->getFunctions();
		foreach ($functions as $func) {
			echo $func . "<br/>\n";
		}
	}
	/**************/
}
?>
