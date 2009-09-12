<?
/**
* test 002 : lecture des propriétés d'utilisateurs
* en mode trace 
*/

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

require("../auth.php");
require("../MoodleWS.php");
require("utils.php");

$options=array(
	'trace'=>true,
	'exceptions'=>false
);

//pb ici si on passe null comme 1er parametre, bascule en mode nonWSDL et 
// n'accepte pas un uri vide dans le constructeur du client SOAP 
$moodle= new MoodleWS("http://cipcnet.insa-lyon.fr/moodle/wspp/wsdl_pp.php",null,$options);

heading ("login IN ");
$lr= $moodle->login(LOGIN,PASSWORD);
print_r_pre($lr);


$users=array('ofranco','ppollet','inconnu');
heading ("get_users:\n ".print_r($users,true));

print_r_pre($moodle->get_users($lr->client,$lr->sessionkey,$users,'username'));

print_trace($moodle);

heading ("logout");
$moodle->logout($lr->client,$lr->sessionkey);

?>
