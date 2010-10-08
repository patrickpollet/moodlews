<?php // $Id: wsdl.php,v 1.5 2007/04/28 04:05:36 PP Exp $

/**
 * This file creates a WSDL file for the web service interfaced running on
 * this server with URL paths relative to the currently running server.
 *
 * When referring to this file, you must call it as:
 *
 * http://www.yourhost.com/ ... /wspp/wsdl_pp.php
 *
 * Where ... is the path to your Moodle root.  This is so that your web server
 * will process the PHP statemtents within the file, which returns a WSDL
 * file to the web services call (or your browser).
 *
 * @version $Id: wsdl.php,v 1.4 2007/04/24 04:05:36 jfilip Exp $
 * @author Justin Filip <jfilip@oktech.ca>
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author PP
 */


ob_start(); //important rev 1.6.4

 require_once('../config.php');

while (@ob_end_clean());  //important rev 1.6.4

 header('Content-Type: text/xml; charset=UTF-8');

 header('Content-Disposition: attachment; filename="moodlews.wsdl"');

// $CFG->ws_uselocalwsdl=0;

 // use Internet to fetch operations & types
// so as to be in sync with clients
if (empty ($CFG->ws_uselocalwsdl)) {
    $wsdl=file_get_contents("$CFG->dirroot/wspp/moodlewsdl.xml");
    $wsdl=str_replace('CFGWWWROOT',$CFG->wwwroot,$wsdl);

} else {
    //tests avec un wsdl generé par la suite wshelper
    // et placé dans chemin_ressources
        $wsdl=$CFG->dataroot.'/wspp/moodlews.wsdl';
    if (!file_exists($wsdl)) {
        make_upload_directory('wspp');
        $data=file_get_contents("$CFG->dirroot/wspp/moodlewsdl.xml");
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