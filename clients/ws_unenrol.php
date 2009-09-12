<?php // $Id: ws_unenrol.php,v 1.0 2008/06/28 03:45:49 PP Exp $
/**
* script qui envoie sur la sortie standard un fichier plat
* prêt à l'emploi pour desinscrire massivement tous les étudiants 
* de tous les cours d'un site Moodle
* ce fichier peut être édité avant d'être uploadé dans les fichiers
* du site comme enrolments.txt 
* les cours ET les utilisateurs DOIVENT avoir un idnumber
* si tel n'est pas le cas se debrouiller avec phpmyadmin
* update mdl_user set idnumber=username where idnumber is null or idnumber=''
* update mdl_course set idnumber = shortname where idnumber is null or idnumber=''
* usage :  php ws_unenrol.php > nom_du_fichier_a_produire 
* les messages d'erreurs sortent à la console ...
* prerequis: installer wspp ET editer/faire tourner wspp/clients/mk_classes.sh pour générer
* la classe MoodleWS adaptée à votre Moodle 
* ce script doit être installé dans un dossier "privé" à la racine de l'install Moodle 
*/

require_once('MoodleWS.php');
require_once("auth.php");

$stderr = fopen('php://stderr', 'w'); 

ini_set('soap.wsdl_cache_enabled', '0');  // Set to '0' for debugging.

$moodle= new MoodleWS();

try {
	//connexion au Web Service
	  $lr= $moodle->login(LOGIN,PASSWORD);
	//print_r($lr);
	//liste des cours du site Moodle 
	//utiliser un login admin pour les avoir tous 
	$courses=$moodle->get_courses($lr->client,$lr->sessionkey,NULL,NULL);
	//print_r($courses);
}
catch (Exception $e) {
	$course=new StdClass;
	$course->error=$e->getMessage();
	$courses->courses[0]=$course;
}
//print_r($courses);

$cpt=0;
foreach($courses->courses as $id=>$course) {
	if (!empty($course->error)) {
		fwrite( $stderr,$course->error."\n");
		continue;
	}
	if (empty($course->idnumber)) {
		fwrite ($stderr,$id." cours ".$course->shortname." sans numero ID\n");
		continue;
	}
	try {
		//liste des inscrits comme étudiants à ce cours (role=5) 
		$users=$moodle->get_users_bycourse($lr->client,$lr->sessionkey,$course->idnumber,'idnumber',5);
	}
	catch (Exception $e) {
	        $user=new StdClass;
        	$user->error=$e->getMessage();
        	$users->users[0]=$user;
	}
//        print_r($users);
	foreach ($users->users as $num=>$user) {
 		if (!empty($user->error)) {
                	fwrite( $stderr,$user->error."\n");
                	continue;
        	}

		  if (empty($user->idnumber)) {
                	fwrite($stderr,$course->idnumber." ".$num." utilisateur ".$user->username." sans numero ID\n");
                	continue;
        	}
		//emission de la ligne de desinscription 
		print "del,student,$user->idnumber,$course->idnumber\n";
	
	}
	$cpt++;
	//if ($cpt>2) break; //TESTS 
	
}

$moodle->logout($lr->client,$lr->sessionkey);
fclose($stderr);
exit();

?>
