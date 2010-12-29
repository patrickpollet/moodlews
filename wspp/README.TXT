This is my version of Web Services for Moodle, based on "OK Technologies 1.4 alpha 
version":http://moodle.org/mod/data/view.php?d=13&rid=573

For discussions see  "Moodle developper forum":http://moodle.org/mod/forum/discuss.php?d=67947

Latest releases, documentations and (hopefully more) on this page
        http://cipcnet.insa-lyon.fr/Members/ppollet/public/moodlews/

Prerequisites :
   
   In current 1.5.x version, Moodle server MUST be running on php5 with soap support. ( php5/nusoap support is 
planned soon by re-injecting code from version 1.4). php4 support is less obvious ...

Installation :


   1 unpack "this archive":http://cipcnet.insa-lyon.fr/Members/ppollet/public/moodlews/latest-version/  in your 
Moodle Web directory

   2 may be limit access to this directory to some trusted machines  by a well crafted .htaccess file ;-)

   3 MUST DO :  Make sure the WSDL file (that describes the offered services ) is accessible by calling in a 
browser   'http://yourmoodle/wspp/wsdl_pp.php ' . It should present you a file (moodlews.wsdl) to download. You 
may cancel  the operation since this file is not needed. It that fails, check the Apache error logs  for reason of 
failure :

            - incorrect location of wspp directory   (file not found)

            - htaccess too restrictive 

            - PHP parse error when parsing wsdl_pp.php ( bad php version or required classes or libraries not 
found)

            - gremlins attack  ...
  

Tests:

    PHP5 clients with built-in SoapClient (extension php_soap installed) : 

         go to clients directory, edit and rename auth.php.dist to auth.php
         file to give a valid user/password (known to Moodle AND having auth method as 'manual' or 'email') 

         MUST DO :check & run once the script ./mkclasses.sh to generate an appropriate client side MoodleWS file 
           or run php ../wsdl2php.php http://yourmoodle/wspp/wsdl_pp.php 

          try the scripts either in command line or via http://

        pp1.php : try some API calls. Values of user's names, ids, idnumbers ...may need to be adapted to your 
site.

        ws_xls_course.php return a CSV file of users having a given role
                     in a given course.
                eg: php ws_xls_course.php 2 5 (all students of course 2)
                    or http://yourmoodle/wspp/clients/ws_course_xls.php?courseid=2&roleid=5

       - for remote access, copy wspp/wsdl2php.php to your workstations and run it by 
       'php wsdl2php.php http://yourmoodle/wspp/wsdl_pp.php'
       This will generate the  MoodleWS.php  with correct URI and the type classes
      needed by your PHP5 clients. (see clients directory)
       - alternatively, copy the complete clients directory (after having ran once the test suite )
         somewhere on a client workstation and use the demo suite scripts as a starting point.  


    PHP5 clients without php_soap extension :

           go to clients directory, edit and rename auth.php.dist to auth.php
          file to give a valid user/password (known to Moodle AND having auth method as 'manual' or 'email')

           MUST DO :check & run once the script ./mkclasses.sh with extra parameter 'nusoap' to generate an 
                appropriate client side MoodleWS_NS.php  file
           or run 'php ../wsdl2php.php http://yourmoodle/wspp/wsdl_pp.php nusoap'   (note the extra parameter) 
           This will generate an appropriate MoodleWS_NS.php file to include in your clients.

           see clients/ws_xls_course_nusoap.php as an example ...Please read the caveats at the top of the script
           (different syntax to access result's members and memory issue ).  
        
    PHP4 clients : 
         
         see clients/ws-test.php that uses (a copy of ) Moodle supplied nusoap library in lib/nusoap.lib
          (so just copy this library to your remote clients ).

    Python clients :
 
          Basic testing :make sure you have SOAPPy installed.
          see clients/ws-test.py

          More sophisticated use : install ZSI and use wsdl2py utility. 
       

    Java clients :

       You must have Apache Axis (tested with 1.4 dated April 2006) .
       See clients/Test1.java

Limitations :

   User provided to the login function MUST exist (of course) AND have its authentication
method set to manual or email .LDAP may work (untested), but not CAS !


Extending operations :

    Save current wspp directory somewhere ...

    You must add new entries in the wsdl_pp.php script in the appropriate XML sections to describe datatypes 
(input & output), messages, ports and operations. 

    Then add the basic call in the class server.class.php (with the proper calls to Moodle's API functions to 
test for rights, fetch the data and eventually filtering it) 

    Add the protocol specific call in mdl_soapserver.php. Code is almost always the same and could be generated 
by a copy/paste of an existing method.  NO Moodle'API call should be there ! 

    MUST DO: run the script wspp/mkclasses.sh or run php wsdl2php.php http://yourmoodle/wspp/wsdl_pp.php server 
    (note the extra parameter server). This will generate a new file MoodleWS.php that includes all classes
    declarations (and base constructors) for existing and new data types. 

    Test , retest and reretest at the command line from wspp/clients directory by :
       
            - rerunning the script wspp/clients/mkclasses.sh at EVERY change to the wspp/wsdl_pp.php file 

            - add the call to your new operation to one of the test scripts (e.g. ppdemo.php for PHP5 with 
               php_soap or ws-test.php for PHP5 without php_soap )  

    When Ok, do not forget to update your remote clients by running on each of them wsdl2php for PHP5 clients 
(with or without nusoap second parameter), wsdl2py for Python clients or WSLD2java for Java clients ...


Acknowledgments:

    - Justin Filip @ OK Technologies for the 1.4 version

    - Catalin Maican for many tests with Visual Studio 2005.

    - Knut Urdalen for version 0.2 of wsld2php

    - Apache foundation for Axis package & WSDL2Java

    - Zolera Systems, Inc. for Z.I.S. Python library 

    - Moodle's team for a clean Moodle API 

License :

    GPL of course !

    Enjoy.


Patrick POLLET   <patrick.pollet@insa-lyon.fr>
INSA de Lyon
 May 2007

