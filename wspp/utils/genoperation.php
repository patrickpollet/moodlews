<?php // $Id: service.php 857 2009-06-07 16:36:53Z ppollet $

/**
 * PHP5 only SOAP server for Moodle
 * @package Web Services
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr>
 * generate all required entries in wsdl far a single moodle table
 */

 set_time_limit(0);

 // required Moodle 2.0
 define('CLI_SCRIPT', true);

require_once ('../../config.php');
require_once ('../wslib.php');

if ($_SERVER['argc'] != 4) {
    die("usage: sudo php genoperation.php tablename recordname opname");
}

$tablename = $_SERVER['argv'][1];
$recordname= $_SERVER['argv'][2];
$opname= $_SERVER['argv'][3];
$opname2= convert_op($opname);

$sql ="describe {$CFG->prefix}$tablename";
try {
    // caution with innoDB, keys names are in lower case !
if ($CFG->wspp_using_moodle20) {
    $res= $DB->get_records_sql($sql);
    $fieldname='field';
    $typename='type';
    $nullname='null';
}
else {
    $res=get_records_sql($sql);
    $fieldname='Field';
    $typename='Type';
    $nullname='Null';
}
//print_r($res);

$details="";
foreach ($res as $field) {
$extra=$field->$nullname=='NO'?'':'nillable="true" ';
$type=get_type($field->$typename);

$details.="\t\t\t<xsd:element name=\"{$field->$fieldname}\" type=\"xsd:{$type}\" $extra />\n";

}
$o=<<<EOS
\t<xsd:complexType name="{$recordname}Record">
\t\t<xsd:all>
\t\t\t<xsd:element name="error" type="xsd:string" />
$details
\t\t</xsd:all>
\t</xsd:complexType>


EOS;

print $o;


$o=<<<EOS
\t<xsd:complexType name="{$recordname}Records">
\t\t <xsd:complexContent>
\t\t\t<xsd:restriction base="SOAP-ENC:Array">
\t\t\t\t<xsd:attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="tns:{$recordname}Record[]" />
\t\t\t</xsd:restriction>
\t\t</xsd:complexContent>
\t</xsd:complexType>


EOS;
print $o;

$o=<<<EOS
\t<xsd:complexType name="{$recordname}Datum">
\t\t<xsd:all>
\t\t\t<xsd:element name="action" type="xsd:string" />
$details
\t\t</xsd:all>
\t</xsd:complexType>


EOS;
print $o;

$o=<<<EOS
\t<xsd:complexType name="{$recordname}Data">
\t\t <xsd:complexContent>
\t\t\t<xsd:restriction base="SOAP-ENC:Array">
\t\t\t\t<xsd:attribute ref="SOAP-ENC:arrayType" wsdl:arrayType="tns:{$recordname}Datum[]" />
\t\t\t</xsd:restriction>
\t\t</xsd:complexContent>
\t</xsd:complexType>


EOS;
print $o;


$o=<<<EOS
\t<xsd:complexType name="{$opname2}Return">
\t\t<xsd:all>
\t\t\t<xsd:element name="{$recordname}s" type="tns:{$recordname}Records" />
\t\t</xsd:all>
\t</xsd:complexType>


EOS;
print $o;

$o=<<<EOS
\t<message name="{$opname}Request">
\t\t<part name="client" type="xsd:int" />
\t\t<part name="sesskey" type="xsd:string" />
<!--   extra parameters goes here
        <part name="XXXids" type="tns:XXXInput" />
        <part name="idfield" type="xsd:string" />
-->
\t</message>


EOS;
print $o;

$o=<<<EOS
\t<message name="{$opname}Response">
\t\t<part name="return" type="tns:{$opname2}Return" />
\t</message>


EOS;
print $o;


$o=<<<EOS
\t<operation name="{$opname}">
\t\t<documentation>MoodleWS: Get  </documentation>
\t\t<input message="tns:{$opname}Request" />
\t\t<output message="tns:{$opname}Response" />
\t</operation>


EOS;
print $o;

$o=<<<EOS
\t<operation name="{$opname}">
\t\t<soap:operation soapAction="CFGWWWROOT/wspp/wsdl#{$opname}" style="rpc" />
\t\t<input>
\t\t<soap:body use="encoded" namespace="CFGWWWROOT/wspp/wsdl" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
\t\t</input>
\t\t<output>
\t\t<soap:body use="encoded" namespace="CFGWWWROOT/wspp/wsdl" encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" />
\t\t</output>
\t</operation>


EOS;
print $o;


} catch (Exception $ex) {
    $info=$ex->getMessage() . '\n' . $ex->getTraceAsString();
    print $info; die();
}


function get_type ($type)  {
    if (strstr($type,'int')) return 'int';
    else return 'string';
}

/**
 * convert a string get_xxx to getXxxx
 * needed to generate date type return consistant with previous convention
 * ie get_forum_discussions --> getFormDiscussions --> getFormDiscussionsReturn
 */
function convert_op($name) {
    $tmp=explode('_',$name);
    $ret=$tmp[0];
    for ($i=1 ; $i < count($tmp); $i++)
        $ret .= ucfirst($tmp[$i]);
    return $ret;

}

?>
