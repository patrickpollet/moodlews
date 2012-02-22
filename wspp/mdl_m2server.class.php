<?php
require_once ('mdl_baseserver.class.php');

class mdl_m2server extends mdl_baseserver {



	function __construct() {
		global $CFG;
		parent :: __construct();
		// skip OKTech internal client validation since it is done by Moodle 2.0 WS servers
		$CFG->oktech_called_fromM2WS=1;
	}
	
	
	/** Moodle 2 Ws implementation requires that all returned data are arrays, not objects ...
	 * 
	 */
	function object_to_array($data) {
		//return $data;
		if(is_array($data) || is_object($data)){
			$result = array(); 
			foreach($data as $key => $value){ 
				$result[$key] = $this->object_to_array($value); 
			}
			return $result;
		}
		return $data;
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
		return $this->object_to_array($res);
	}

	/**
	  * to be overriden in others protocol specific classes
	  *
	*/
	protected function to_array($res, $keyName, $className, $emptyMsg) {
		 if (!$res || !is_array($res) || (count($res) == 0))
                return $this->object_to_array($this->error_record($className, $emptyMsg));
         return $this->object_to_array( $res) ;
	}
	
	 /** Send the error information to the WS client
     * formatted as XML document.
     * to be overriden in descendant classes
     * @param exception $ex
     * @return void
     * TODO a more restful return
     */
	protected function send_error($ex=null) {
        $debuginfo='';
    	if ($ex) {
        	$info = $ex->getMessage();
        	if (1 || debugging() and isset($ex->debuginfo)) {
            	$debuginfo = $ex->debuginfo;
        	}
    	} else {
        	$info = 'Unknown error';

    	}
    	$this->debug_output($info.' - '.$debuginfo);
    	
            	$xml = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
            	$xml .= '<EXCEPTION class="'.get_class($ex).'">'."\n";
            	$xml .= '<MESSAGE>'.htmlentities($info, ENT_COMPAT, 'UTF-8').'</MESSAGE>'."\n";
            	if (debugging() and isset($ex->debuginfo)) {
                	$xml .= '<DEBUGINFO>'.htmlentities($debuginfo, ENT_COMPAT, 'UTF-8').'</DEBUGINFO>'."\n";
            	}
            	$xml .= '</EXCEPTION>'."\n";
        

        $this->send_headers();
        echo $xml;
        	die (); // needed
    	}


}
?>