<?php
// +------------------------------------------------------------------------+
// | wsdl2php                                                               |
// +------------------------------------------------------------------------+
// | Copyright (C) 2005 Knut Urdalen <knut.urdalen@telio.no>                |
// +------------------------------------------------------------------------+
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS    |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT      |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR  |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT   |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,  |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT       | 
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,  |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY  |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT    |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE  |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.   |
// +------------------------------------------------------------------------+
// | This software is licensed under the LGPL license. For more information |
// | see http://www.urdalen.no/wsdl2php                                     |
// +------------------------------------------------------------------------+
/* 
  Revision 0.2.7 pp 08/05/2007 
  Patrick Pollet :<patrick.pollet@insa-lyon.fr> 
  1) added integer to list of primitives types
  2) added a default constructor to each class type generated to simplify SOAP returns
      in case of errors, see mdl_soapserver.php for usage  
  3) do no emit "typehints" in function prototypes if no class file was 
       generated for a parameter because it was skipped (eg string[])   
  4) if param 2 == 'server', DO not generate the class MoodleWS , that is not
     needed on the server side ... 
  5) added and private attribute $uri to MoodleWS class, set in contructor and 
     used in all methods. This make possible to run clients out of the box without
     running this utility by specifying the server's URI in MoodleWS construction
     e.g. $moodle=new MoodleWS($uri="http://yourmoodle/wspp/wsdl"); 
  6) modified client's code generation to use  soap_client's nuSoap class if command line arg='nusoap' 
     (php5 & SoapClient still required for generation !). In that case the generated file &
     and class name is PACKAGE_NS instead of PACKAGE. This required that the MoodleWS class
     do not extends anymore SoapClient, but has a private attribute $client instanciated
     to a SoapClient or a soap_client depending of command line option 'nusoap'.  
  7) made public MoodleWS 's class attributes client and proxy for debugging purpose
  8) generate phpdoc comments for attributes (wshelper compatible) 

  Revision 0.2.8 PP 13/06/2008 
      - generate a full constructor instead of default for all datatypes in CLIENT mode
       (server mode needs only a blank one to fullfill soap requirments)
      - added array of in parameters comment if relevant 
      - generate accessors for attributes of datatypes (todo ? make the attributes private ??)        
      - generate test code for all operations .
      -must cast result ofSOAP calls to real dataType to be able to call the get* accessors (
              PHP SoapClient return an instance of StydClass, not the real type !
  Revision 0.2.9 PP 26/06/2008
     -added DEBUG clause ATOP service class to prevent wsdl caching by PHP 
  Revision 0.2.10 PP 16/12/2008
     -added login and logout in tests scripts

  CAUTION: STILL uses SoapClient to retrieve the WSDL to parse,
     so retricted to PHP5 with php_soap enabled for generation 
  TODO : find a way to have a running version for php5/nusoap and (maybe) php4/nusoap ... 
*/


//error_reporting(E_ALL ^ E_NOTICE);

define ('PACKAGE','MoodleWS');
define ('AUTHOR','Patrick Pollet :<patrick.pollet@insa-lyon.fr>');
define ('COPYRIGHT','(c) P.Pollet 2007 under GPL');

ini_set('soap.wsdl_cache_enabled', 0); // disable WSDL cache

if( $_SERVER['argc'] != 2 && $_SERVER['argc'] != 3  ) {
  die("usage: wsdl2php <wsdl-file or http://yourmoodle/wspp/wsdl_pp.php> [server|nusoap]\n");
}

/**
* command line parameters
* $1 string required : the URL or File name of the WSDL file
* $2 string optional :
*      if 'server', will not generate the MoodleWS client class. Useful on the server side
*              after modifiying operations 
*      if 'nusoap', will generate a client MoodleWS class using nusoap's soap_client instead
*         of php built-in SoapClient 
*/

$wsdl = $_SERVER['argv'][1];
if (isset($_SERVER['argv'][2])) {
	$server= $_SERVER['argv'][2]=="server";
	$useNuSOAP=$_SERVER['argv'][2]=="nusoap";
}else {
    $server=$useNuSOAP=false;
}



try {
  $client = new SoapClient($wsdl);
} catch(SoapFault $e) {
  die($e);
}

$dom = DOMDocument::load($wsdl);

// get documentation
$nodes = $dom->getElementsByTagName('documentation');
$doc = array('service' => '',
	     'operations' => array());
foreach($nodes as $node) {
  if( $node->parentNode->localName == 'service' ) {
    $doc['service'] = trim($node->parentNode->nodeValue);
  } else if( $node->parentNode->localName == 'operation' ) {
    $operation = $node->parentNode->getAttribute('name');
    //$parameterOrder = $node->parentNode->getAttribute('parameterOrder');
    $doc['operations'][$operation] = trim($node->nodeValue);
  }
}

// get targetNamespace
$targetNamespace = '';
$nodes = $dom->getElementsByTagName('definitions');
foreach($nodes as $node) {
  $targetNamespace = $node->getAttribute('targetNamespace');
}

// declare service
$service = array('class' => $dom->getElementsByTagNameNS('*', 'service')->item(0)->getAttribute('name'),
		 'wsdl' => $wsdl,
		 'doc' => $doc['service'],
		 'functions' => array());

// PHP keywords - can not be used as constants, class names or function names!
$keywords = array('and', 'or', 'xor', 'as', 'break', 'case', 'cfunction', 'class', 'continue', 'declare', 'const', 'default', 'do', 'else', 'elseif', 'enddeclare', 'endfor', 'endforeach', 'endif', 'endswitch', 'endwhile', 'eval', 'extends', 'for', 'foreach', 'function', 'global', 'if', 'new', 'old_function', 'static', 'switch', 'use', 'var', 'while', 'array', 'die', 'echo', 'empty', 'exit', 'include', 'include_once', 'isset', 'list', 'print', 'require', 'require_once', 'return', 'unset', '__file__', '__line__', '__function__', '__class__', 'abstract');

// ensure legal class name (I don't think using . and whitespaces is allowed in terms of the SOAP standard, should check this out and may throw and exception instead...)
$service['class'] = str_replace(' ', '_', $service['class']);
$service['class'] = str_replace('.', '_', $service['class']);
$service['class'] = str_replace('-', '_', $service['class']);

if(in_array(strtolower($service['class']), $keywords)) {
  $service['class'] .= 'Service';
}

// verify that the name of the service is named as a defined class
if(class_exists($service['class'])) {
  throw new Exception("Class '".$service['class']."' already exists");
}

/*if(function_exists($service['class'])) {
  throw new Exception("Class '".$service['class']."' can't be used, a function with that name already exists");
}*/






// get operations
$operations = $client->__getFunctions();
foreach($operations as $operation) {

  /*
   This is broken, need to handle
   GetAllByBGName_Response_t GetAllByBGName(string $Name)
   list(int $pcode, string $city, string $area, string $adm_center) GetByBGName(string $Name)

   finding the last '(' should be ok
   */
  //list($call, $params) = explode('(', $operation); // broken
  
  //if($call == 'list') { // a list is returned
  //}
  
  /*$call = array();
  preg_match('/^(list\(.*\)) (.*)\((.*)\)$/', $operation, $call);
  if(sizeof($call) == 3) { // found list()
    
  } else {
    preg_match('/^(.*) (.*)\((.*)\)$/', $operation, $call);
    if(sizeof($call) == 3) {
      
    }
  }*/

  $matches = array();
  if(preg_match('/^(\w[\w\d_]*) (\w[\w\d_]*)\(([\w\$\d,_ ]*)\)$/', $operation, $matches)) {
    $returns = $matches[1];
    $call = $matches[2];
    $params = $matches[3];
  } else if(preg_match('/^(list\([\w\$\d,_ ]*\)) (\w[\w\d_]*)\(([\w\$\d,_ ]*)\)$/', $operation, $matches)) {
    $returns = $matches[1];
    $call = $matches[2];
    $params = $matches[3];
  } else { // invalid function call
    throw new Exception('Invalid function call: '.print_r($operation,true));
  }

  $params = explode(', ', $params);

  $paramsArr = array();
  foreach($params as $param) {
    $paramsArr[] = explode(' ', $param);
  }
  //  $call = explode(' ', $call);
  $function = array('name' => $call,
		    'method' => $call,
		    'return' => $returns,
		    'doc' => $doc['operations'][$call],
		    'params' => $paramsArr);

  // ensure legal function name
  if(in_array(strtolower($function['method']), $keywords)) {
    $function['name'] = '_'.$function['method'];
  }

  // ensure that the method we are adding has not the same name as the constructor
  if(strtolower($service['class']) == strtolower($function['method'])) {
    $function['name'] = '_'.$function['method'];
  }

  // ensure that there's no method that already exists with this name
  // this is most likely a Soap vs HttpGet vs HttpPost problem in WSDL
  // I assume for now that Soap is the one listed first and just skip the rest
  // this should be improved by actually verifying that it's a Soap operation that's in the WSDL file
  // QUICK FIX: just skip function if it already exists
  $add = true;
  foreach($service['functions'] as $func) {
    if($func['name'] == $function['name']) {
      $add = false;
    }
  }
  if($add) {
    $service['functions'][] = $function;
  }
}

$types = $client->__getTypes();

//print_r($types);

//integer added by PP !!! 
$primitive_types = array('string','integer','int', 'long', 'float', 'boolean', 'dateTime', 'double', 'short', 
'UNKNOWN', 'base64Binary'); // TODO: dateTime is special, maybe use PEAR::Date or similar
$service['types'] = array();

//take note of array of data types for better hinting in comments 
$array_types=array();
$custom_types=array();

foreach($types as $type) {
  $parts = explode("\n", $type);
  $classes = explode(" ", $parts[0]);
  $class = $classes[1];
  
 if( substr($class, -2, 2) == '[]' ) { // array skipping
    $array_types[substr($class,0,strlen($class)-2)]=$classes[0];
    continue;
  }

  if( substr($class, 0, 7) == 'ArrayOf' ) { // skip 'ArrayOf*' types (from MS.NET, Axis etc.)
    $array_types[substr($class,8)]=$classes[0];
    continue;
  }

  $custom_types[]=$class;

  $members = array();
  for($i=1; $i<count($parts)-1; $i++) {
    $parts[$i] = trim($parts[$i]);
    list($type, $member) = explode(" ", substr($parts[$i], 0, strlen($parts[$i])-1) );

    // check syntax
    if(preg_match('/^$\w[\w\d_]*$/', $member)) {
      throw new Exception('illegal syntax for member variable: '.$member);
      continue;
    }

    // IMPORTANT: Need to filter out namespace on member if presented
    if(strpos($member, ':')) { // keep the last part
      list($tmp, $member) = explode(':', $member);
    }

    // OBS: Skip member if already presented (this shouldn't happen, but I've actually seen it in a WSDL-file)
    // "It's better to be safe than sorry" (ref Morten Harket) 
    $add = true;
    foreach($members as $mem) {
      if($mem['member'] == $member) {
	$add = false;
      }
    }
    if($add) {
      $members[] = array('member' => $member, 'type' => $type);
    }
  }

  $service['types'][] = array('class' => $class, 'members' => $members);
}
//print_r($service);
//print_r($members);
//print_r($array_types);
//print_r($custom_types);
// add types
foreach($service['types'] as $type) {
  $code = "/**\n";
  if (isset($type['doc']))
  	$code .= " * ".$type['doc']."\n";
  $code .= " * \n";
  $code .= " * @package\t".PACKAGE."\n";
  $code .= " * @copyright\t".COPYRIGHT."\n";
  $code .= " */\n";

  $code .= "class ".$type['class']." {\n";
  foreach($type['members'] as $member) {
    //phpDoc type comment for wshelper 
   if  (isset($array_types[$member['type']]))
			$hint = "(".$member['type'].") array of ".$array_types[$member['type']];
		else 
			$hint= $member['type'];
    $code .= "\t/** \n\t* @var  ".$hint."\n\t*/\n";
    $code .= "\tpublic \$".$member['member'].";\n";
  }
  if ($server) 
        $code .= gen_def_constructor($type);  // to make blank instances with ALL members present (SOAP requirments) 
  else 
         $code .= gen_full_constructor($type); // to help clients to create properly initialized instances
  $code .= gen_accessors($type); 
       
  $code .= "}\n\n";

  print "Writing ".$type['class'].".php...";
  $filename = $type['class'].".php";
  $fp = fopen($filename, 'w');
  fwrite($fp, "<?php\n".$code."?>\n");
  fclose($fp);
  print "ok\n";
}

// add service

// page level docblock
$code = "/**\n";
$code .= " * ".$service['class']." class file\n";
$code .= " * \n";
$code .= " * @author    ".AUTHOR."\n";
$code .= " * @copyright ".COPYRIGHT."\n";
$code .= " * @package   ".PACKAGE."\n";
$code .= " */\n\n";
$code .= "define('DEBUG',true);\n";
$code .= "if (DEBUG) ini_set('soap.wsdl_cache_enabled', '0');  // no caching by php in debug mode\n\n";


// require types
foreach($service['types'] as $type) {
  $code .= "/**\n";
  $code .= " * ".$type['class']." class\n";
  $code .= " */\n";
  $code .= "require_once '".$type['class'].".php';\n";
}



$code .= "\n";


// to avoid confusion , generate the class name and filename with _NS appended
// if using nusoap

$service['class']= $useNuSOAP ?($service['class'].'_NS'):($service['class']);

$testcode="require_once ('".$service['class'].".php');\n\n\$moodle=new ".$service['class']."();\n";


//generate client client if needed 
if (!$server) {
                if ($useNuSOAP) {
                   $code .= "require_once 'lib/nusoap.php';\n\n";
                }
		// class level docblock
		$code .= "/**\n";
		$code .= " * ".$service['class']." class\n";
		$code .= " * \n";
		$code .= parse_doc(" * ", $service['doc']);
		$code .= " * \n";
		$code .= " * @author    ".AUTHOR."\n";
		$code .= " * @copyright ".COPYRIGHT."\n";
		$code .= " * @package   ".PACKAGE."\n";
		$code .= " */\n";

		$code .= "class ".$service['class']." {\n\n";
		// these two attributes are made public for debugging purpose
		// i.e. accessing $moodle->client->__getLast* methods
                // should be private in prod version ... 
		$code .= "  public \$client;\n\n";
                if ($useNuSOAP) {
			$code .= "  public \$proxy;\n\n";
                }
		$code .= "  private \$uri = '".$targetNamespace."';\n\n";
		$code .= "  public function ".$service['class']."(\$wsdl = \"".$service['wsdl']."\", \$uri=null, \$options = array()) {\n";
		$code .= "    if(\$uri != null) {\n";
		$code .= "      \$this->uri = \$uri;\n";
		$code .= "    };\n";
                if ($useNuSOAP) {
			$code .="     \$this->client = new soap_client(\$wsdl, true);\n";
                        $code .="     \$this->proxy=\$this->client->getProxy();\n";
                } else {
			$code .= "    \$this->client = new SoapClient(\$wsdl, \$options);\n";
		}
		$code .= "  }\n\n";

                $code .=add_utils_fonctions();

		foreach($service['functions'] as $function) {
		  $code .= "  /**\n";
		  $code .= parse_doc("   * ", $function['doc']);
		  $code .= "   *\n";

		  $signature = array(); // used for function signature
		  $para = array(); // just variable names
		  foreach($function['params'] as $param) {
			if  (isset($array_types[$param[0]]))
				$code .= "   * @param ($param[0]) array of ".$array_types[$param[0]]." ".$param[1]."\n";
			else 
				$code .= "   * @param ".$param[0]." ".$param[1]."\n";
			// no typehints if not in generated classes (arrays ...)   
			if (in_array($param[0], $primitive_types))  //never for primitive types (php5 !)
			   $signature[] = $param[1];
			else { //only if a classfile has been generated above  
			   $typehint = false;
			   foreach($service['types'] as $type) {
				 if($type['class'] == $param[0]) {
					 $typehint = true;
				 }
			   }
			  $signature[] = ($typehint) ? implode(' ', $param) : $param[1];
			}
			$para[] = $param[1];
		  }
		  $code .= "   * @return ".$function['return']."\n";
		  $code .= "   */\n";
		  $code .= "  public function ".$function['name']."(".implode(', ', $signature).") {\n";
                  if ($useNuSOAP) 
		      $code .= "    \$res= \$this->proxy->".$function['name']."(".implode(', ', $para).");\n";
		  else { 
                      $code .= "    \$res= \$this->client->__call('".$function['method']."', array(";
		      $params = array();
		      if(!in_array('', $signature)) { // no arguments!
		          foreach($signature as $param) {
			     if(strpos($param, ' ')) { // slice 
			       $param = array_pop(explode(' ', $param));
			     }
			     $params[] = "      new SoapParam(".$param.", '".substr($param, 1, strlen($param))."')";
		           }
		           $code .= "\n      ";
		           $code .= implode(",\n      ", $params);
		           $code .= "\n      ),\n";
		     } else {
			$code .= "),\n";
		     }
		     $code .= "      array(\n";
                     $code .= "            'uri' => \$this->uri ,\n";
		     $code .= "            'soapaction' => ''\n";
		     $code .= "           )\n";
		     $code .= "      );\n";
                  }
                  //cast the returned StdClass to the REAL datatype axs per the WSDL
		  if (in_array($function['return'],$custom_types)) 
			$code.= "  return \$this->castTo ('".$function['return']."',\$res);\n";
		  else $code .="   return \$res;\n";
		  $code .= "  }\n\n";
                  $testcode .=gen_test_code ($function,$function['name']!='login' && $function['name']!='logout');
		  gen_test_code_in_separate_file($function);
		}
		$code .= "}\n\n";
}

print "Writing ".$service['class'].".php...";
$fp = fopen($service['class'].".php", 'w');
fwrite($fp, "<?php\n".$code."?>\n");
fclose($fp);
print "ok\n";
if (!$server) {

	print "Writing test_".$service['class'].".php...";
	$fp = fopen("test_".$service['class'].".php", 'w');
	fwrite($fp, "<?php\n".$testcode."?>\n");
	fclose($fp);
	print "ok\n";
}

print ("Generated ".count($service['functions'])." functions calls and ".count($service['types'])." custom datatypes\n");


function parse_doc($prefix, $doc) {
  $code = "";
  $words = split(' ', $doc);
  $line = $prefix;
  foreach($words as $word) {
    $line .= $word.' ';
    if( strlen($line) > 50 ) { // new line
      $code .= $line."\n";
      $line = $prefix;
    }
  }
  $code .= $line."\n";
  return $code;
}



function gen_def_constructor ($type) {

  $code ="\t public function ${type['class']}() {\n";

  foreach($type['members'] as $member) {
    $code.="\t\t \$this->${member['member']}=".get_default_value($member['type']).";\n";
  }
  $code .="\t}\n";
  return $code;
}

function gen_full_constructor ($type) {

  $code="\t/* full constructor */\n";
  $code .="\t public function ${type['class']}(";
  $cpt=0;
  foreach($type['members'] as $member) {
     if ($cpt) $code .=',';
     $cpt++;
     $code .='$'.$member['member']."=".get_default_value($member['type']);	
  }
  $code .="){\n";

  foreach($type['members'] as $member) {
                $code .="\t\t \$this->${member['member']}=\$${member['member']}   ;\n";
  }
  $code .="\t}\n";
  return $code;
}


function get_default_value ($type) {
  global $primitive_types,$array_types;
  switch ($type) {
        case 'integer':;
        case 'long':;
        case 'short':;
        case 'int':
                return "0";break;
        case 'float':;
        case 'double':
                 return "0.0";break;
        case 'string': return "''";break;
        case 'boolean': return "false";break;
        default : // assume complex type
		if (isset($array_types[$type]))
			return "array()";
              	else 
			return "NULL";
          break ;
    }

}

function gen_accessors($type) {
  $code= "\t/* get accessors */"."\n";

  foreach($type['members'] as $member) {
    $code .="\tpublic function get".ucfirst($member['member'])."(){\n";
    $code .="\t\t return \$this->".$member['member'].";\n";     
    $code .="\t}\n\n";
  }

  $code .="\t/*set accessors */"."\n";

  foreach($type['members'] as $member) {
    $code .="\tpublic function set".ucfirst($member['member'])."(\$${member['member']}){\n";
    $code .="\t\t\$this->".$member['member']."=\$${member['member']};\n";
    $code .="\t}\n\n";
  }


  return $code;
}

function get_set_calls ($varname,$vartype) {
	global $service;
	foreach ($service['types'] as $type) {
		if ($type['class']==$vartype) {
			$code="";
			foreach ($type['members'] as $member) {
				$code .=$varname."->set".ucfirst($member['member'])."(".get_default_value($member['type']).");\n";
			}
			return $code;
		}
	} 
	return "";
}

function get_get_calls ($varname,$vartype) {
	global $service;
	foreach ($service['types'] as $type) {
		if ($type['class']==$vartype) {
			$code="\n";
			foreach ($type['members'] as $member) {
				$code .="print($varname"."->get".ucfirst($member['member'])."());\n";
			}
			return $code;
		}
	} 
	return "";
}

function gen_test_code ($function,$withLogin=true) {
  global $primitive_types,$array_types;
  $code="/**test code for ".($function['doc']?$function['doc']:$function['name'])."\n";
  foreach($function['params'] as $param) 
		if  (isset($array_types[$param[0]]))
			$code .= "* @param ($param[0]) array of ".$array_types[$param[0]]." ".$param[1]."\n";
		else 
			$code .= "* @param ".$param[0]." ".$param[1]."\n";
  $code .= "* @return ".$function['return']."\n";
  $code .="*/\n";
 if ($withLogin) 
	$code .= "\n\$lr=\$moodle->login(LOGIN,PASSWORD);\n";
  $params=array();
  $retours="";
  foreach ($function['params'] as $num=>$param) {
	if ($param[0]) {  // in some wsdl the message tag is just empty 
		if (in_array($param[0], $primitive_types)) {
			if ($withLogin && $num==0)
				$params[]="\$lr->getClient()";
			elseif ($withLogin && $num==1)
				$params[]="\$lr->getSessionKey()";
			else $params[]=get_default_value($param[0]);
		}
		else {
			$params[]=$param[1];
			if (isset($array_types[$param[0]])) {
				$code .=$param[1]."=array();\n";
			} else {
				$code.=$param[1]."= new ".$param[0]."();\n";
				$code .=get_set_calls($param[1],$param[0]);
			}
		}
	}
  } 
  if (in_array($function['return'], $primitive_types)) {
	$code .="\$res=\$moodle->".$function['name']."(".implode(',',$params).");\n";
  	$code.="print(\$res);";

  } else  {
	//type cast is required to have acces to get Fonctions, otherwise the result is StdClass
	// does not work in php5 cast is only allowed for few types 
	//$code .="\$res=(".$function['return'].")(\$moodle->".$function['name']."(".implode(',',$params)."));\n";
	$code .="\$res=\$moodle->".$function['name']."(".implode(',',$params).");\n";
	$code.="print_r(\$res);";
	$retours=get_get_calls("\$res",$function['return']);
	}
  $code .=$retours;
  if ($withLogin) 
	$code .= "\n\$moodle->logout(\$lr->getClient(),\$lr->getSessionKey());";	
  $code .="\n\n";
  return $code;
}

function gen_test_code_in_separate_file ($function) {
	global $service;
	if (!is_dir("tests"))
        	mkdir("tests");

	$testcode="require_once ('../".$service['class'].".php');\n\n\$moodle=new ".$service['class']."();\n";
	$testcode.="require_once ('../auth.php');\n";
	if ($function['name'] !='login' && $function['name'] !='logout')
		$testcode .=gen_test_code($function,true);
	else 
		$testcode .=gen_test_code($function, false);
	print "Writing tests/test_".$function['name'].".php...";
	$fp = fopen("tests/test_".$function['name'].".php", 'w');
	fwrite($fp, "<?php\n".$testcode."?>\n");
	fclose($fp);
	print "ok\n";
}

function add_utils_fonctions() {

$code='';
$code.='  function castTo($className,$res){ '."\n";
$code.='     if (class_exists($className)) {  '."\n" ;
$code.='        $aux= new $className();       '."\n";
$code.='        foreach ($res as $key=>$value) '."\n";
$code.='             $aux->$key=$value;        '."\n";
$code.='        return $aux;                   '."\n";
$code.='     } else                            '."\n";
$code.='        return $res;                   '."\n";
$code.='  }                                   '."\n \n";

//print $code;
return $code;
}


?>
