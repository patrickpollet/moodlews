<?php
require_once ('mdl_baseserver.class.php');

class mdl_restserver extends mdl_baseserver {

	private $formatout = 'php';
	private $singleshot = false;

	function __construct($formatout) {
		parent :: __construct();
		$this->setFormatout($formatout); // may raise an exception
	}

	/**
	 * Sends an fatal error response back to the client  and STOP the processing
	 *  @override server
	 * @param string $msg The error message to return.
	 * @return void
	 */
	protected function error($msg) {
		if ($this->singleshot)
			server :: logout($_REQUEST['client'], $_REQUEST['sesskey']);
		server :: error($msg); //log in error msg
		throw new Exception("Wspp Rest Server :" . $msg);
	}

	protected function send_headers() {
		switch ($this->formatout) {
			case 'xml' :
                 header('Content-Type: application/xml; charset=utf-8');
				header('Content-Disposition: inline; filename="response.xml"');
				break;
			case 'dump' :
                 header('Content-Type: text/html; charset=utf-8');
				header('Content-Disposition: inline; filename="response.txt"');
				break;
			default :
				// what could be the good header for php, json or pojo ????
				break;
		}
		parent :: send_headers();
	}



	 /**
     * Send the error information to the WS client
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
    	switch ($this->formatout) {
        	case 'xml':
            	$xml = '<?xml version="1.0" encoding="UTF-8" ?>'."\n";
            	$xml .= '<EXCEPTION class="'.get_class($ex).'">'."\n";
                $xml .= '<MESSAGE>'.htmlspecialchars($info, ENT_COMPAT, 'UTF-8').'</MESSAGE>'."\n";
                //$xml .= '<MESSAGE>'.$info.'</MESSAGE>'."\n";
            	if (debugging() and isset($ex->debuginfo)) {
                	$xml .= '<DEBUGINFO>'.htmlspecialchars($debuginfo, ENT_COMPAT, 'UTF-8').'</DEBUGINFO>'."\n";
                    //$xml .= '<DEBUGINFO>'.$debuginfo.'</DEBUGINFO>'."\n";
            	}
            	$xml .= '</EXCEPTION>'."\n";
                break;
            case 'dump':
                $xml=$info.' - '.$debuginfo;
                break;
            default :
                $xml='';

        }
        $this->send_headers();
        echo $xml;
        	die (); // needed
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
       // $this->debug_output("to_single ".print_r($res,true));
		return $res;
	}

	/**
	  * to be overriden in others protocol specific classes
	  *
	*/
	protected function to_array($res, $keyName, $className, $emptyMsg) {
		 if (!$res || !is_array($res) || (count($res) == 0))
                return array($this->error_record($className, $emptyMsg));
         return $res;
	}

	/**
	* if Moodle has complained some way return content of ob_buffer
	* else pass the real result (from to_soap or to_soaparray ) to be sent in XML
	* must be called at every return to client
	*/

	protected function serialize($result) {
		switch ($this->formatout) {
			case 'php' :
				return serialize($result);
				break;
			case 'json' :
				return json_encode($result);
				break;
			case 'xml' :
				return '<RESPONSE>' . "\n" . $this->xmlize($result) . '</RESPONSE>' . "\n";
				break;
			case 'dump' :
				return '<pre>' . print_r($result, true) . '</pre>';
				break;
			case 'pojo' :
				return $this ->pojoize($result);
				break;
			default :
				return $this->error(get_string('ws_unknownoutputformat', 'local_wspp', $this->formatout));
				break;
		}
		return $result;
	}

	/**
	 * TODO
	 */
	protected function pojoize($result) {
		return $result;
	}

	/**
	 * very similar to Moodle 2.0 REST function webservice/rest/locallib.php@xmlize_result
	 * so we expected that parsing by existing Moodle 2.0 clients will be the same ...
	 */
	protected function xmlize($result) {

		if (is_array($result)) {
			$mult = '<MULTIPLE>' . "\n";
			if (!empty ($result)) {
				foreach ($result as $val) {
					$mult .= $this->xmlize($val);
				}
			}
			$mult .= '</MULTIPLE>' . "\n";
			return $mult;

		} else
			if (is_object($result)) {
				$single = '<SINGLE>' . "\n";
				foreach ($result as $key => $val) {

					$single .= '<KEY name="' . $key . '">' . $this->xmlize($val) . '</KEY>' . "\n";
				}
				$single .= '</SINGLE>' . "\n";
				return $single;

			} else
				if (is_scalar($result)) {
					//return '<VALUE>' . htmlentities($result, ENT_COMPAT, 'UTF-8') . '</VALUE>' . "\n";
                     return '<VALUE>'.$result.'</VALUE>'."\n";

				} else {
					return '<VALUE null="null"/>' . "\n";
				}

	}

	/**
	 * @param string $wsfunction  the called operation name
	 * @uses $_REQUEST
	 */
	private function trysingleshot($wsfunction) {
		if ($wsfunction === 'login')
			return;
		if (!empty ($_REQUEST['wsusername']) && !empty ($_REQUEST['wspassword'])) {
			$lr = server :: login($_REQUEST['wsusername'], $_REQUEST['wspassword']);
			// if no exception sent
			unset ($_REQUEST['wsusername']);
			unset ($_REQUEST['wspassword']); // do not log them !!!
			//$this->debug_output("singleshot_login" . print_r($lr, true));
			$this->singleshot = true;
			//does not work order of elements are changed ..
			$_REQUEST['client'] = $lr->getClient();
			$_REQUEST['sesskey'] = $lr->getSessionKey();
		}
	}

	/**
	 * we must do some refection since there is no garantee that the expected parameters
	 * will be in the proper order in the global $_REQUEST
	 */
	public function handle($wsfunction) {
		try {
			$method = new ReflectionMethod($this, $wsfunction);
		} catch (ReflectionException $ex) {
			$this->error(get_string('ws_unknownoperation', 'local_wspp', $wsfunction));
		}
		if (!$method->isPublic()) {
			$this->error(get_string('ws_unknownoperation', 'local_wspp', $wsfunction));
		}

		$this->trysingleshot($wsfunction);
		$expectedparameters = $method->getParameters();

		$params = array ();
		foreach ($expectedparameters as $expectedparameter) {
			$pname = $expectedparameter->getName();
			if (isset ($_REQUEST[$pname]))
				$params[] = $_REQUEST[$pname];
			else {
				if ($expectedparameter->isDefaultValueAvailable())
					$params[] = $expectedparameter->getDefaultValue(); // caution
				else
					$this->error(get_string('ws_missingvalue', 'local_wspp', $pname));
			}
		}
		//$this->debug_output("rest_input=" . print_r($params, true));
		$res = call_user_func_array(array (
			$this,
			$wsfunction
		), $params);
		//$this->debug_output("rest_output" . print_r($res, true));

		if ($this->singleshot) {
			$lr = server :: logout($_REQUEST['client'], $_REQUEST['sesskey']);
			//$this->debug_output("singleshot_logout" . print_r($lr, true));
		}
		$this->send_headers(); // in REST mode we send headers even in case of no errors
		print $res;
		die();
	}

	public function setFormatout($formatout) {
		switch ($formatout) {
			case 'php' :
			case 'json' :
			case 'xml' :
			case 'dump' :
			case 'pojo' :
				$this->formatout = $formatout;
				break;
			default :
				return $this->error(get_string('ws_unknownoutputformat', 'local_wspp', $formatout));
				break;
		}
	}

}
?>