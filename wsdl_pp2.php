<?php // $Id: wsdl_pp.php 428 2010-10-21 13:45:47Z ppollet $

/**
 * This file creates a WSDL file for the web service interfaced running on
 * this server with URL paths relative to the currently running server.
 *
 * This version use a simplified version of the Moodle wsdl file generated
 * by WSHelper utility (major difference withe the regular one is the absence of names
 * in returned complex datatypes
 *
 *
 *
 * When referring to this file, you must call it as:
 *
 * http://www.yourhost.com/ ... /wspp/wsdl_pp2.php
 *
 * Where ... is the path to your Moodle root.  This is so that your web server
 * will process the PHP statemtents within the file, which returns a WSDL
 * file to the web services call (or your browser).
 *
 * @version $Id: wsdl_pp.php 428 2010-10-21 13:45:47Z ppollet $
 * @author Justin Filip <jfilip@oktech.ca>
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author PP
 */


ob_start(); //important rev 1.6.4

 require_once('../config.php');

while (@ob_end_clean());  //important rev 1.6.4

 header('Content-Type: text/xml; charset=UTF-8');

 header('Content-Disposition: attachment; filename="moodlews2.wsdl"');

// $CFG->ws_uselocalwsdl=0;

 // use Internet to fetch operations & types
// so as to be in sync with clients
if (empty ($CFG->ws_uselocalwsdl)) {
    $wsdl=file_get_contents("$CFG->dirroot/wspp/moodlewsdl2.xml");
    $wsdl=str_replace('CFGWWWROOT',$CFG->wwwroot,$wsdl);

} else {
    //tests avec un wsdl generé par la suite wshelper
    // et placé dans chemin_ressources
        $wsdl=$CFG->dataroot.'/wspp/moodlews2.wsdl';
    if (!file_exists($wsdl)) {
        make_upload_directory('wspp');
        $data=file_get_contents("$CFG->dirroot/wspp/moodlewsdl2.xml");
        $data=str_replace('CFGWWWROOT',$CFG->wwwroot,$data);
        if ($fd = @fopen($wsdl, 'wb')) {
            fwrite($fd, $data);
            fclose($fd);
        }
    }
    //lecture XML
    $wsdl=file_get_contents($wsdl);
}




// bug avec php 5.3.0 si taille >8192 bytes
// http://www.magentocommerce.com/boards/viewthread/56528/
// revision 1035 lenght était mal écrit (lenght) !!!

header ('Content-Length:'.strlen($wsdl));

echo $wsdl;
die();
?>