<?php // $Id: service_pp.php,v 1.5.1 2007/05/02 04:05:36 ppollet Exp $

/**
 * PHP5 only SOAP server for Moodle  
 * @package Web Services
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr>
 */

/*revisions
 1.5.1 :added a basic support for enumeration of functions (a la nusoap)
*/

// get Moodle site config infos
require_once('../config.php');
// SOAP service class
require('mdl_soapserver.class.php');

// use Internet to fetch operations & types
// so as to be in sync with clients
$wsdl=$CFG->wwwroot."/wspp/wsdl_pp.php";

$server=new SoapServer($wsdl);

// all function of this class are calleable if cited in wsdl_pp file 
$server->setClass("mdl_soapserver");

if ($_SERVER["REQUEST_METHOD"] == "POST") 

	$server->handle();
/*************/
else { 
echo "Ce serveur SOAP peut gérer les fonctions suivantes : ";
  $functions = $server->getFunctions();
  foreach($functions as $func) {
    echo $func . "\n";
  }
}
/**************/

?>
