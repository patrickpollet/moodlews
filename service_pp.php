<?php // $Id$

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

//$CFG->ws_uselocalwsdl=0;

// use Internet to fetch operations & types
// so as to be in sync with clients
if (empty($CFG->ws_uselocalwsdl)) {
    $wsdl=$CFG->wwwroot."/wspp/wsdl_pp.php";
} else {
    //some versions of PHP 5 have a problem reading 'big wsdls over the Internet'
    // but not from a 'locally copied' wsdl file
    // see http://bugs.php.net/bug.php?id=48216
    // so we created the appropriate wsdl file in moodle's data dir (in call to wsdl.php) and use it also here'
    $wsdl=$CFG->dataroot.'/wspp/moodlews.wsdl';
}

$server=new SoapServer($wsdl);

// all function of this class are calleable if cited in wsdl_pp file
$server->setClass("mdl_soapserver");

if ($_SERVER["REQUEST_METHOD"] == "POST")

	$server->handle();
/*************/
else {
echo "Ce serveur SOAP peut g�rer les fonctions suivantes : ";
  $functions = $server->getFunctions();
  foreach($functions as $func) {
    echo $func . "<br/>\n";
  }
}
/**************/

?>
