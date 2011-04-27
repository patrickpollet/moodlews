<?php


// $Id$

/**
 * class for SOAP protocol-specific server layer. PHP 5 ONLY (may throw an exception !)
 *
 * @package Web Services
 * @version $Id$
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca>  v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5, 1.6
 */

/**
 * rev 1.6.7 : added phpdoc style comments compatible with wshelper utility
 *   thus allwoing in a near future to generate the wsdl on the fly from this class and data classes
 *
 * rev 1.7 Moodle 2.0 exceptions handling compatible
 */

// base class that performs data extraction/injection
require_once ('mdl_baseserver.class.php');


if (DEBUG)
    ini_set('soap.wsdl_cache_enabled', '0'); // no caching by php in debug mode)


//testing new simplified wsdl generated with WSHelper utility
// the value of the fla is set in script service_pp.php (false) or service_pp2.php (true)
// @see method to_soap_array()
//$CFG->wsdl_simplified=0;

class mdl_soapserver extends mdl_baseserver {

    /**
     * Constructor method.
     *
     * @param none
     * @return mdl_soapserver
     */
    function __construct() {
        global $CFG;
        parent :: __construct();
    }


     /**
     * Send the error information to the WS client
     * formatted as XML document.
     * to be overriden in descendant classes
     * @param exception $ex
     * @return void
     */
    protected function send_error($ex=null) {
        if ($ex) {
            $info = $ex->getMessage();
            if (1 || debugging() and isset($ex->debuginfo)) {
                $info .= ' - '.$ex->debuginfo;
            }
        } else {
            $info = 'Unknown error';
        }
        $this->debug_output($info);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
<SOAP-ENV:Body><SOAP-ENV:Fault>
<faultcode>MOODLE:error</faultcode>
<faultstring>'.$info.'</faultstring>
</SOAP-ENV:Fault></SOAP-ENV:Body></SOAP-ENV:Envelope>';

        $this->send_headers();
        header('Content-Type: application/xml');
        header('Content-Disposition: inline; filename="response.xml"');

        echo $xml;
        die(); // needed ???
    }


    /**
    * Sends an fatal error response back to the client.
    *  @override server
    * @param string $msg The error message to return.
    * @return void
    */
    protected function error($msg) {
        parent :: error($msg); //log in error msg
        throw new SoapFault("Wspp Server", $msg);
    }

 
    /**
    * return a SOAP ready array with filled in attributes from a Moodle object
    * or a blank array with attribute error set
    */
    private function to_soap($res, $className) {

        //Lille : in case to_soap is made from to_soap_array
        if (!is_array($res) && !is_object($res)) {
            $this->debug_output("LilleDebug  _mdl_soapserver.class/to_soap_ =>  Not Object and not array");
            return $this->error_record($className, $res);
        }
        //end Lille

        if (!isset ($res->error) || empty ($res->error)) {
            //in case server class missed some attributes ...
            $soap_res = $this->blank_array($className);
            foreach ($res as $key => $value)
                $soap_res[$key] = $value;
            $soap_res['error'] = '';
            return $soap_res;
        } else
            return $this->error_record($className, $res->error);
    }

    /**
    * Convert an array of objects returned by server class to the appropriate format
    * This function should be called for all data returned to client
        * @param array of object $res , may be null
    * @param string $keyName the name used for the array key , eg 'users','groups' ... as
    *    defined in the wsdl

    * @param string $className. The PHP class of the returned  item(s). this class must exist
    * in server's working directory . To generate it, use wsdl2php utility (or mkclasses.sh script)
    * @param string $errMsg the error message to be sent if  no results found.
    * Note that every returned object should have an error attribute set by server class in case
    * it is invalid
    * In case of "fatal errors" (invalid client, not enough rights ..., $res will contains only one
    *  record with error set.
    * In case of not "fatal errrors" (such as one course among a list of course is invalid...),
    *  all "good records" should have error attribute to blank and all bads should have error
    *  attribut set to the cause of the failure.
    * @return an array of arrays
    */

    private function to_soap_array($res, $keyName, $className, $emptyMsg) {
        global $CFG;
        $return = array ();
        if (empty($CFG->wsdl_simplified)) {
            if (!$res || !is_array($res) || (count($res) == 0))
                $return[$keyName][] = $this->error_record($className, $emptyMsg);
            else {
                foreach ($res as $r) {
                    $return[$keyName][] = $this->to_soap($r, $className);
                }
            }
        } else {
            if (!$res || !is_array($res) || (count($res) == 0))
                $return[] = $this->error_record($className, $emptyMsg);
            else {
                foreach ($res as $r) {
                    $return[] = $this->to_soap($r, $className);
                }

            }
        }
       // $this->debug_output(print_r($return, true));
        return $return;

        }


  /**
       * to be overriden in others protocol specific classes
       */
      protected function to_primitive($res) {
            return $res;
      }

      /**
       * to be overriden in others protocol specific classes
       */
      protected function to_single($res, $className) {
            return $this->to_soap($res, $className);
      }

     /**
       * to be overriden in others protocol specific classes
     */
     protected function to_array($res, $keyName, $className, $emptyMsg) {
            return $this->to_soap_array($res, $keyName, $className, $emptyMsg);
     }

}
?>
