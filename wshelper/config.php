<?php


//set_include_path(get_include_path() . PATH_SEPARATOR . ".." .PATH_SEPARATOR . "../..");

/* All the allowed webservice classes */
$WSClasses = array(
        "cipc_soapserver",
        "MoodleWS"
);

/* The classmap associative array. When you want to allow objects as a parameter for
 * your webservice method. ie. saveObject($object). By default $object will now be
 * a stdClass, but when you add a classname defined in the type description in the @param 
 * documentation tag and add your class to the classmap below, the object will be of the
 * given type. Requires PHP 5.0.3+ 
 */
$WSStructures = array(
	"table3"=>"table3",
	"etudiant" => "etudiant",
	"groupe" => "groupe",
	"fiche_ects"  => "fiche_ects"
        
);

?>
