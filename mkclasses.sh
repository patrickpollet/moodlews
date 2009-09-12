#!/bin/sh
# If you modify the operations accepted by the server (new operations, changing & adding
# parameters .. YOU MUST rerun that script to adjust the MoodleWS.php used by the server class.
# Don't forget to update your clients local or remote  (see clients/mkclasses.sh)  
# you may have to adjust the exact Moodle location below (localhost should just do fine).

php ./wsdl2php.php http://moodle.insa-lyon.fr/wspp/wsdl_pp.php server


 

