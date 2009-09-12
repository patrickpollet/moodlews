<?php // $Id: ws_getusers.php,v 1.0 2008/06/28 03:45:49 PP Exp $
/**
* usage :  php ws_getusers.php > nom_du_fichier_a_produire 
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
        $users=$moodle->get_users($lr->client,$lr->sessionkey,NULL,NULL);
	
}
catch (Exception $e) {
         $user=new StdClass;
         $user->error=$e->getMessage();
         $users->users[0]=$user;
}

//       print_r($users);

$fields=array('id','lastname','firstname','idnumber','department','institution','address','email');


header("content-type: application/vnd.ms-excel");
header("content-disposition: attachment; filename=$strFic");

echo (implode("\t",$fields)."\n");
foreach ($users->users as $user) {
        if (!$user->error) {
                foreach($fields as $field) {
                        print($user->$field."\t");
                }
                print("\n");
        }else {
                print("$user->error\n");
        }
}

$moodle->logout($lr->client,$lr->sessionkey);
fclose($stderr);
exit();

?>
