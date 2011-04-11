<?php


// $Id$

/**
 * class for SOAP protocol-specific server layer. PHP 5 ONLY (may throw an exception !)
 *
 * @package Web Services
 * @version $Id$
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca>  v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5, 1.6
 */

/**
 * rev 1.6.7 : added phpdoc style comments compatible with wshelper utility
 *   thus allwoing in a near future to generate the wsdl on the fly from this class and data classes
 *
 * rev 1.7 Moodle 2.0 exceptions handling compatible
 */

// base class that performs data extraction/injection
require_once ('server.class.php');

// list of required classes for input/output data
// rev 1.8   main include script and utility classes are now in a directory named classes. (see wsdl2php)
require_once ('classes/MoodleWS.php');

//define('DEBUG',true);

if (DEBUG)
    ini_set('soap.wsdl_cache_enabled', '0'); // no caching by php in debug mode)


//testing new simplified wsdl generated with WSHelper utility
// the value of the fla is set in script service_pp.php (false) or service_pp2.php (true)
// @see method to_soap_array()
//$CFG->wsdl_simplified=0;

class mdl_soapserver extends server {

    /**
     * Constructor method.
     *
     * @param none
     * @return mdl_soapserver
     */
    function __construct() {
        global $CFG;

		// rev 1.7 use an xception handler to catch all errors sent by Moodle 2.0
		// with Moodle 1.9 we use our function error() that throw a soap exception
		// that is also catched here
        set_exception_handler(array($this,'exception_handler'));
        /// Necessary for processing any DB upgrades in Moodle 1.9 (not in 2.0)
        parent :: server();
        //turn off output of calls to debugging() that messup the XML
        // see lib/gradelib.php
        $CFG->debug = 0;
        ob_start(); //rev 1.6 buffer all Moodle ouptuts see send function
    }

    /**
     * specific exception handling for Moodle 2.0
     * code borrowed from Moodle's webservice '
     * changed to protected for WsHelper utility that must skip it...
     * BACK to public otherwise not called !!!
     * we get  AFatal error  Call to protected method mdl_soapserver::exception_handler() from context '' in <b>Unknown</b> on line <b>0</b><br />
     * @return void
     */
    function  exception_handler($ex) {
        global $CFG;
    	if ($CFG->wspp_using_moodle20)
    		// detect active db transactions, rollback and log as error
        	abort_all_db_transactions();
        // now let the plugin send the exception to client
        $this->send_error($ex);
        // not much else we can do now, add some logging later
        exit(1);
    }

     /**
     * Send the error information to the WS client
     * formatted as XML document.
     * @param exception $ex
     * @return void
     */
    protected function send_error($ex=null) {
        // Zend Soap server fault handling is incomplete compared to XML-RPC :-(
        // we can not use: echo $this->zend_server->fault($ex);
        //TODO: send some better response in XML
        if ($ex) {
            $info = $ex->getMessage();
            if (1 || debugging() and isset($ex->debuginfo)) {
                $info .= ' - '.$ex->debuginfo;
            }
        } else {
            $info = 'Unknown error';
        }
        $this->debug_output($info);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
<SOAP-ENV:Body><SOAP-ENV:Fault>
<faultcode>MOODLE:error</faultcode>
<faultstring>'.$info.'</faultstring>
</SOAP-ENV:Fault></SOAP-ENV:Body></SOAP-ENV:Envelope>';

        $this->send_headers();
        header('Content-Type: application/xml');
        header('Content-Disposition: inline; filename="response.xml"');

        echo $xml;
    }

     /**
     * Internal implementation - sending of page headers.
     * @return void
     */
    protected function send_headers() {
        header('Cache-Control: private, must-revalidate, pre-check=0, post-check=0, max-age=0');
        header('Expires: '. gmdate('D, d M Y H:i:s', 0) .' GMT');
        header('Pragma: no-cache');
        header('Accept-Ranges: none');
    }

    /**
     * if Moodle has complained some way return content of ob_buffer
     * else pass the real result (from to_soap or to_soaparray ) to be sent in XML
     * must be called at every return to client
     */

    private function send($result) {
        if (ob_get_length() && trim(ob_get_contents())) {
            /// Return an error with  the contents of the output buffer.
            $msg = trim(ob_get_contents());
            ob_end_clean();
            return $this->error($msg);
        }
        ob_end_clean();
        return $result;
    }

    /**
    * Sends an fatal error response back to the client.
    *  @override server
    * @param string $msg The error message to return.
    * @return void
    */
    protected function error($msg) {
        parent :: error($msg); //log in error msg
        throw new SoapFault("Wspp Server", $msg);
    }

    /** since SOAP requires all attributes fields to be filled, even in case of error
    * this function return a "blank array", with error attribute set to $errMsg
    * className is the name of the returned class built with our wsdl2php utility against our WSDL file
        */

    private function blank_array($className) {
        if (class_exists($className)) {
            $res = new $className ();
            return get_object_vars($res); // convert to array
        } else
            // throw a fatal exception SoapFault
            $this->error("internal error :class $className not found !");
    }

    private function error_record($className, $errMsg) {
        $res = $this->blank_array($className);
        $res['error'] = $errMsg;
        return $res;
    }

    /**
    * return a SOAP ready array with filled in attributes from a Moodle object
    * or a blank array with attribute error set
    */
    private function to_soap($res, $className) {

        //Lille : in case to_soap is made from to_soap_array
        if (!is_array($res) && !is_object($res)) {
            $this->debug_output("LilleDebug  _mdl_soapserver.class/to_soap_ =>  Not Object and not array");
            return $this->error_record($className, $res);
        }
        //end Lille

        if (!isset ($res->error) || empty ($res->error)) {
            //in case server class missed some attributes ...
            $soap_res = $this->blank_array($className);
            foreach ($res as $key => $value)
                $soap_res[$key] = $value;
            $soap_res['error'] = '';
            return $soap_res;
        } else
            return $this->error_record($className, $res->error);
    }

    /**
    * Convert an array of objects returned by server class to the appropriate format
    * This function should be called for all data returned to client
        * @param array of object $res , may be null
    * @param string $keyName the name used for the array key , eg 'users','groups' ... as
    *    defined in the wsdl

    * @param string $className. The PHP class of the returned  item(s). this class must exist
    * in server's working directory . To generate it, use wsdl2php utility (or mkclasses.sh script)
    * @param string $errMsg the error message to be sent if  no results found.
    * Note that every returned object should have an error attribute set by server class in case
    * it is invalid
    * In case of "fatal errors" (invalid client, not enough rights ..., $res will contains only one
    *  record with error set.
    * In case of not "fatal errrors" (such as one course among a list of course is invalid...),
    *  all "good records" should have error attribute to blank and all bads should have error
    *  attribut set to the cause of the failure.
    * @return an array of arrays
    */

    private function to_soap_array($res, $keyName, $className, $emptyMsg) {
        global $CFG;
        $return = array ();
        if (empty($CFG->wsdl_simplified)) {
            if (!$res || !is_array($res) || (count($res) == 0))
                $return[$keyName][] = $this->error_record($className, $emptyMsg);
            else {
                foreach ($res as $r) {
                    $return[$keyName][] = $this->to_soap($r, $className);
                }
            }
        } else {
            if (!$res || !is_array($res) || (count($res) == 0))
                $return[] = $this->error_record($className, $emptyMsg);
            else {
                foreach ($res as $r) {
                    $return[] = $this->to_soap($r, $className);
                }

            }
        }
       // $this->debug_output(print_r($return, true));
        return $return;

        }

    /**
      * Validates a client's login request.
      * @param string $username
      * @param string password
      * @return loginReturn
      */
    public function login($username, $password) {
        return $this->send(parent :: login($username, $password));
    }

    /**
       * Logs a client out of the system by removing the valid flag from their
       * session record and any user ID that is assosciated with their particular
       * session.
       *
       * @param int $client The client record ID.
       * @param string $sesskey The client session key.
       * @return boolean True if successfully logged out, false otherwise.
       */
    public function logout($client, $sesskey) {
        return parent :: logout($client, $sesskey);
    }


        /**
    * determine the primary role of user in a course
    * @param int $client The client session record ID.
    * @param string $sesskey The session key returned by a previous login.
    * @param string userid
    * @param string useridfield
    * @param string courseid
    * @param string courseidfield
    * @return int
    *          1 admin
    *          2 coursecreator
    *          3 editing teacher
    *          4 non editing teacher
    *          5 student
    *          6 guest IF course allows guest AND username ==guest
    *          0 nothing
    * since this operation retunr s a simple type, no need to override it in protocol specific layer
    * starting at rev 1.8 it must also be here for parsing by genwslp.php
    */
    public function get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield) {
        return parent::get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield);
        }


    /**
    * determine if user has (at least) a given role in a course
    * @param int $client The client session record ID.
    * @param string $sesskey The session key returned by a previous login.
    * @param string userid
    * @param string useridfield
    * @param string courseid
    * @param string courseidfield
    * @param int roleid
    * @return boolean True if Ok , False otherwise.
    * since this operation retunr s a simple type, no need to override it in protocol specific layer
    * starting at rev 1.8 it must also be here for parsing by genwslp.php
    */
    public function has_role_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $roleid) {
        return parent::has_role_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $roleid);
    }

    /**  =====  OVERRIDE SERVER METHODS NEEDING SOAP-SPECIFIC HANDLING  ======  **/

    /**
     * Edit user records (add/update/delete).
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param userDatum[] $users An array of user records (objects or arrays) for editin   (including opertaion to perform).
     * @return userRecord[] An array of user objects.
     */
    public function edit_users($client, $sesskey, $users) {
        global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editUsersInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editUsersInput();
            $aux->setUsers($users);
        } else $aux=$users;
        //$this->debug_output('Attempting to update user IDS MDL_S: ' . print_r($aux, true));
        return $this->send($this->to_soap_array(parent :: edit_users($client, $sesskey, $aux), 'users', 'userRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * Find and return a list of user records.
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string[] $userids An array of input user id values. If empty, all users are returned
     * @param string $idfield : the id field to use for searching users ('id', 'idnumber' ...)
     *    not necessarly unique ...
     * examples in Python :
     *       proxy.get_users(a,b,['astrid','pguy','toto'],'username')
     *       proxy.get_users(a,b,['alexis'],'firstname')
     *       proxy.get_users(a,b,['alexis','astrid'],'firstname')
     *       proxy.get_users(a,b,[1],'deleted')
     * @return userRecord[]  An array of user records.
     */
    public function get_users($client, $sesskey, $userids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_users($client, $sesskey, $userids, $idfield), 'users', 'userRecord', get_string('nousers', 'local_wspp')));
    }

    /**
     * Find Edit course records (add/update/delete).
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param courseDatum[] $courses An array of course records (objects or arrays) for
     *                         editing (including operation to perform).
     * @return courseRecord[] An array of course records.
     */
    public function edit_courses($client, $sesskey, $courses) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editCoursesInput();
            $aux->setCourses($courses);
        } else $aux=$courses;
        return $this->send($this->to_soap_array(parent :: edit_courses($client, $sesskey, $aux), 'courses', 'courseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * Find and return a list of course records.
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string[] $courseids An array of input course id values to search for. If empty return all courses
     * @param string $idfield : the field used to identify courses
     * @return courseRecord[] An array of resource records.
     */
    public function get_courses($client, $sesskey, $courseids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_courses($client, $sesskey, $courseids, $idfield), 'courses', 'courseRecord', get_string('nocourses', 'local_wspp')));
    }

    /**
     * rev 1.6.2
     * find and return a list of courses having $search in their name, fullname or description
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $search A string of criteria to search eventually separated by space if empty return all course
     * @return courseRecord[] An array of resource records.
     */
    function get_courses_search($client, $sesskey, $search) {
        return $this->send($this->to_soap_array(parent :: get_courses_search($client, $sesskey, $search), 'courses', 'courseRecord', get_string('nocourses', 'local_wspp')));

    }

    /**
    * Find and return a list of activities within one or several courses.
    * TODO cast returned data to more specific types
    * currently return only a "generic description"
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input course id values to search for. If empty return all ressources
    * @param string $idfield : the field used to identify courses
    * @param string $type : activity type i.e. forum, wiki, assignment ...
    * @return resourceRecord[] An array of records.
    */
    public function get_instances_bytype($client, $sesskey, $courseids, $idfield = 'idnumber', $type = 'resource') {
        return $this->send($this->to_soap_array(parent :: get_instances_bytype($client, $sesskey, $courseids, $idfield, $type), 'resources', 'resourceRecord', get_string('noressources', 'local_wspp') . $type));
    }

    /**
    * Find and return a list of ressources within one or several courses.
    * OK PP tested with php5 5 and python clients
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input course id values to search for. If empty return all ressources
    * @param string $idfield : the field used to identify courses
    * @return resourceRecord[] An array of resource records.
    */
    public function get_resources($client, $sesskey, $courseids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_resources($client, $sesskey, $courseids, $idfield), 'resources', 'resourceRecord', get_string('noresources', 'local_wspp')));
    }

    /**
    * Find and return a list of sections within one or several courses.
    * OK PP tested with php5 5 and python clients
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $courseids An array of input courses id values to search for. If empty return all sections
    * @param string $idfield : the field used to identify courses
    * @return sectionRecord[] An array of section records.
    */
    public function get_sections($client, $sesskey, $courseids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_sections($client, $sesskey, $courseids, $idfield), 'sections', 'sectionRecord', get_string('nosections', 'local_wspp')));
    }

    /**
     * Enrol users as a student in the given course.
     * prerequisite : corresponding students records MUST exist in Moodle
     * OK PP tested with php5 5 and python clients
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $courseid The course ID number to enrol students
     * @param string $courseidfield The field used to identify course (idnumber,id,shortname...)
     * @param string[] $userids An array of input user idnumber values for enrolment.
     * @param string $idfield student identifier, default idnumber
     * @return enrolRecord[] Return data (user_student records) to be converted into a
     *               specific data format for sending to the client.
     */
    public function enrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: affect_role_incourse($client, $sesskey,'student', $courseid, $courseidfield, $userids, $idfield, true), 'students', 'enrolRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
         * unEnrol users as a student in the given course.
         * prerequisite : corresponding students records MUST exist in Moodle
         * OK PP tested with php5 5 and python clients
         * @param int $client The client session ID.
         * @param string $sesskey The client session key.
         * @param string $courseid The course ID number to enrol students
         * @param string $courseidfield The field used to identify course (idnumber,id,shortname...)
         * @param string[] $userids An array of input user idnumber values for enrolment.
         * @param string $idfield student identifier, default idnumber
         * @return enrolRecord[] Return data (user_student records) to be converted into a
         *               specific data format for sending to the client.
         */
    public function unenrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: affect_role_incourse($client, $sesskey, 'student', $courseid, $courseidfield, $userids, $idfield, false), 'students', 'enrolRecord', get_string('nothingtodo','local_wspp')));
    }

    /**
     * Find and return student grades for specified courses  (moodle 1.9)
     * NOTE Courses MUST have an id_number
     * @uses $CFG
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userid The Student ID of the student.
     * @param string $useridfield the field used to identity student
     * @param string[] $courseids Array of course ids , if empty all grades
     * @param string $courseidfield field used to identity the courses
     * @return gradeRecord[] student grades
     *
     */
    public function get_grades($client, $sesskey, $userid, $useridfield = 'idnumber', $courseids, $courseidfield = "idnumber") {
        return $this->send($this->to_soap_array(parent :: get_grades($client, $sesskey, $userid, $useridfield, $courseids, $courseidfield), 'grades', 'gradeRecord', get_string('nogradesfor', 'local_wspp', $userid)));

    }

     /**
     * Find and return student grades for currently enrolled courses  (moodle 1.9)
     *
     * @uses $CFG
     * @use get_grades by first creating an array of courses Moodle's ids
     * Courses MUST have a non empty ID number for this call to succeed
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userid The Student ID of the student.
     * @param string $idfield the field used to identity student
     * @return gradeRecord[] student grades
     *
     */
    public function get_user_grades($client, $sesskey, $userid, $idfield = "idnumber") {

        return $this->send($this->to_soap_array(parent :: get_user_grades($client, $sesskey, $userid, $idfield), 'grades', 'gradeRecord', "no grades  found for user $userid"));

    }

    /**
     * Find and return course grades for currently enrolled students  (moodle 1.9)
     *
     * @uses $CFG
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $courseid course id number
     * @param string $idfield field used to identity the course
     * @return gradeRecord[] student grades
     */
    public function get_course_grades($client, $sesskey, $courseid, $idfield = "idnumber") {

        return $this->send($this->to_soap_array(parent :: get_course_grades($client, $sesskey, $courseid, $idfield), 'grades', 'gradeRecord', get_string('nogradesin', 'local_wspp', $courseid)));

    }

    /**
     * get one user record with idfield=userinfo.
     * may return several users records if idfield is not a key
     * eg. proxy.get_user(a,b,'alexis','firstname')
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $userinfo The Student info to search.
     * @param string $idfield the field used to search student
     * @return userRecord[]
     */

    public function get_user($client, $sesskey, $userinfo, $idfield) {
        return $this->get_users($client, $sesskey, array (
            $userinfo
        ), $idfield);
    }

    /**
     * Find and return a list of courses that a user is a member of.
     *
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $uinfo (optional) Moodle's id of user. If absent, uses current session user id
     * @param string $idfield  the field used to identity user
     * @param string $sort (optional). If absent use parent's default (by fullname)
     * @return courseRecord[] Return data (course record) to be converted into a specific
     *               data format for sending to the client.
     */

    private function _get_mycourses_by($client, $sesskey, $uinfo, $idfield, $sort) {
        return $this->send($this->to_soap_array(parent :: get_my_courses($client, $sesskey, $uinfo, $idfield, $sort), 'courses', 'courseRecord', get_string('nocourses', 'local_wspp')));

    }

    /**
       * Find and return a list of courses that a user identified by Moodle's id is a member of.
       *
       * @param int $client The client session ID.
       * @param string $sesskey The client session key.
       * @param string $uid (optional) Moodle's id of user. If absent, uses current session user id
       * @param string $sort (optional). If absent use parent's default (by fullname)
       * @return courseRecord[] Return data (course record) to be converted into a specific
       *               data format for sending to the client.
       */
    public function get_my_courses($client, $sesskey, $uid = '', $sort = '') {
        return $this->_get_mycourses_by($client, $sesskey, $uid, 'id', $sort);
    }

    /**
    * Find and return a list of courses that a user identified by Moodle's username is a member of.
    *
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid (optional) Moodle's username. If absent, uses current session user id
    * @param string $sort (optional). If absent use parent's default (by fullname)
    * @return courseRecord[] Return data (course record) to be converted into a specific
    *               data format for sending to the client.
    */
    public function get_my_courses_byusername($client, $sesskey, $uid = '', $sort = '') {
        return $this->_get_mycourses_by($client, $sesskey, $uid, 'username', $sort);
    }

    /**
       * Find and return a list of courses that a user identified by Moodle's idnumber is a member of.
       *
       * @param int $client The client session ID.
       * @param string $sesskey The client session key.
       * @param string $uid (optional) Moodle's idnumber of user. If absent, uses current session user id
       * @param string $sort (optional). If absent use parent's default (by fullname)
       * @return courseRecord[] Return data (course record) to be converted into a specific
       *               data format for sending to the client.
       */
    public function get_my_courses_byidnumber($client, $sesskey, $uid = '', $sort = '') {
        return $this->_get_mycourses_by($client, $sesskey, $uid, 'idnumber', $sort);
    }

    /**
    * Get an user record from it's login name
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $userinfo  Moodle's login of user.
    * @return userRecord[] Return data (user  record) to be converted into a specific
    *               data format for sending to the client.
    */
    public function get_user_byusername($client, $sesskey, $userinfo) {
        return $this->get_user($client, $sesskey, $userinfo, 'username');
    }

    /**
    * Get an user record from it's id number (an optional info in Moodle)
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $userinfo  Moodle's id number .
    * @return userRecord[] Return data (user  record) to be converted into a specific
    *               data format for sending to the client.
    */

    public function get_user_byidnumber($client, $sesskey, $userinfo) {
        return $this->get_user($client, $sesskey, $userinfo, 'idnumber');
    }

    /**
     * Get an user record from it's id  (the main Moodle id key)
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param int $userinfo  Moodle's id .
     * @return userRecord[] Return data (user  record) to be converted into a specific
     *               data format for sending to the client.
     */
    public function get_user_byid($client, $sesskey, $userinfo) {
        return $this->get_user($client, $sesskey, $userinfo, 'id');
    }

    /**
    * return the list of groups of course identified by courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid the course identifier
    * @param string $idfield  the course identifier field, defaut = idnumber
    * @return groupRecord[]  Array of groupRecord
    */
    public function get_groups_bycourse($client, $sesskey, $courseid, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_groups_bycourse($client, $sesskey, $courseid, $idfield), 'groups', 'groupRecord', get_string('nogroupsin', 'local_wspp', $courseid)));
    }

      /**
    * return the list of groupings of course identified by courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid the course identifier
    * @param string $idfield  the course identifier field, defaut = idnumber
    * @return groupingRecord[]
    */
    public function get_groupings_bycourse($client, $sesskey, $courseid, $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_groupings_bycourse($client, $sesskey, $courseid, $idfield), 'groupings', 'groupingRecord', get_string('nogroupingsin', 'local_wspp', $courseid)));
    }

    /**
    * internal, not published (yet) in wsdl.
    * @see get_group_byid, get_groups_byname
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $groups an array of group identifiers
    * @param string $idfield  the group's Moodle identifier
    * @param int course the id of the course to serach (0 = any course)
    * @return groupRecord[]
    */
    protected function get_groups($client, $sesskey, $groups, $idfield, $courseid = 0) {
        return $this->send($this->to_soap_array(parent :: get_groups($client, $sesskey, $groups, $idfield, $courseid), 'groups', 'groupRecord', get_string('nogroups', 'local_wspp')));
    }

    /**
    * internal, not published (yet) in wsdl.
    * @see get_grouping_byid, get_groupings_byname
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $groups an array of grouping identifiers
    * @param string $idfield  the grouping's Moodle identifier
    * @param int course the id of the course to serach (0 = any course)
    * @return groupingRecord[]
    */
    protected function get_groupings($client, $sesskey, $groups, $idfield, $courseid = 0) {
        return $this->send($this->to_soap_array(parent :: get_groupings($client, $sesskey, $groups, $idfield, $courseid), 'groupings', 'groupingRecord', get_string('nogroupings', 'local_wspp')));
    }

    /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the group's Moodle identifier
    * @return groupRecord[]  Array of groupRecord
    */
    public function get_group_byid($client, $sesskey, $groupid) {
        return $this->get_groups($client, $sesskey, array (
            $groupid
        ), 'id', 0);
    }

    /**
    * return one or several groupRecord for groups having name $name
    * and (optionally) belonging to course $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupname  the group's Moodle name
    * @param int $courseid  optional
    * @return groupRecord[]  Array of groupRecord
    *
    */
    public function get_groups_byname($client, $sesskey, $groupname, $courseid = 0) {
        return $this->get_groups($client, $sesskey, array (
            $groupname
        ), 'name', $courseid);
    }

      /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the group's Moodle identifier
    * @return groupRecord[]  Array of groupRecord
    */
    public function get_grouping_byid($client, $sesskey, $groupid) {
        return $this->get_groupings($client, $sesskey, array (
            $groupid
        ), 'id', 0);
    }

    /**
    * return one or several groupRecord for groups having name $name
    * and (optionally) belonging to course $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupname  the group's Moodle name
    * @param int $courseid
    * @return groupRecord[]  Array of groupRecord
    *
    */
    public function get_groupings_byname($client, $sesskey, $groupname, $courseid = 0) {
        return $this->get_groupings($client, $sesskey, array (
            $groupname
        ), 'name', $courseid);
    }

    /**
    * internal, not published (yet) in wsdl.
    * @see get_cohort_byid, get_cohorts_byname, get_cohort_byidnumber
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string[] $groups an array of cohort identifiers
    * @param string $idfield  the cohort's Moodle identifier
    * @return groupRecord[]  Array of groupRecord
    */

    protected function get_cohorts($client, $sesskey, $groups, $idfield) {
        global $CFG;
         if (!$CFG->wspp_using_moodle20)
           return $this->error(get_string('ws_moodle20only', 'local_wspp'));
        return $this->send($this->to_soap_array(parent :: get_cohorts($client, $sesskey, $groups, $idfield), 'cohorts', 'cohortRecord', get_string('nocohorts', 'local_wspp')));
    }



    /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $groupid  the cohort's Moodle identifier
    * @return cohortRecord[]  Array of cohortRecord
    */
    public function get_cohort_byid($client, $sesskey, $groupid) {
        return $this->get_cohorts($client, $sesskey, array (
            $groupid
        ), 'id');
    }

       /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $cohortIdNumber  the cohort's Moodle identifier
    * @return cohortRecord[]
    */
    public function get_cohort_byidnumber($client, $sesskey, $groupid) {
        return $this->get_cohorts($client, $sesskey, array (
            $groupid
        ), 'idnumber');
    }

      /**
    * return one groupRecord  identified by Moodle's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $cohortName
    * @return cohortRecord[]  Array of cohortRecord
    */
    public function get_cohorts_byname($client, $sesskey, $groupid) {
        return $this->get_cohorts($client, $sesskey, array (
            $groupid
        ), 'name');
    }

    /**
    * return members of group identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupid  the group's Moodle identifier
    * @param string $groupidfield the filed used to identity the group
    * @return userRecord[]  Array of user Record
    */
    public function get_group_members($client, $sesskey, $groupid, $groupidfield = 'id') {

        return $this->send($this->to_soap_array(parent :: get_group_members($client, $sesskey, $groupid, $groupidfield), 'users', 'userRecord', get_string('nousers', 'local_wspp')));

    }

    /**
    * return members of grouping identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $groupid  the grouping's Moodle identifier
    * @param string $groupidfield the filed used to identity the grouping
    * @return userRecord[]  Array of user Record
    */
    public function get_grouping_members($client, $sesskey, $groupid, $groupidfield = 'id') {

        return $this->send($this->to_soap_array(parent :: get_grouping_members($client, $sesskey, $groupid, $groupidfield), 'users', 'userRecord', get_string('nousers', 'local_wspp')));

    }

    /**
    * return members of cohort identified by $groupeid (Moodle id )
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $id  the group's Moodle identifier
    * @param string $idfield the filed used to identity the group
    * @return userRecord[]  Array of user Record
    */
    public function get_cohort_members($client, $sesskey, $groupid, $groupidfield = 'id') {

        return $this->send($this->to_soap_array(parent :: get_cohort_members($client, $sesskey, $groupid, $groupidfield), 'users', 'userRecord', get_string('nousers', 'local_wspp')));

    }

    /**
    * return groups to which user $uid belongs to
    * if $uid is empty, use current logged in user.
    * otherwise, current logged in user must be admin to fetch data
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid  Moodle's  user to search
    * @param string $idfield field name to search .
    * @return groupRecord[]
    *
    */
    public function get_my_groups($client, $sesskey, $uid = '', $idfield = 'idnumber') {
        return $this->send($this->to_soap_array(parent :: get_my_groups($client, $sesskey, $uid, $idfield), 'groups', 'groupRecord', get_string('nogroups', 'local_wspp')));
    }

    /**
    * return cohorts to which user $uid belongs to
    * if $uid is empty, use current logged in user.
    * otherwise, current logged in user must be admin to fetch data
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $uid  Moodle's  user to search
    * @param string $idfield field name to search .
    * @return cohortRecord[]
    *
    */
    public function get_my_cohorts($client, $sesskey, $uid = '', $idfield = 'idnumber') {
          global $CFG;
         if (!$CFG->wspp_using_moodle20)
           return $this->error(get_string('ws_moodle20only', 'local_wspp'));

        return $this->send($this->to_soap_array(parent :: get_my_cohorts($client, $sesskey, $uid, $idfield), 'cohorts', 'cohortRecord', get_string('nocohorts', 'local_wspp')));
    }


    /**
    * Return user's group(s)  in course identified by $courseid
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $uid  Moodle's id for user to search
    * @param int $idfield  Moodle's table column for user to search
    * @param string $courseid course to serach into
    * @param string $courseidfield field used to identify course
    * @return groupRecord[] Return data (array of group  record) to be converted into a specific
    *               data format for sending to the client.
    *
    */

    public function get_my_group($client, $sesskey, $uid, $idfield,$courseid, $courseidfield = 'id') {
        $rres = array ();
        $course = ws_get_record('course', $courseidfield,$courseid );
        if (!$course)
            return $this->error(get_string('ws_courseunknown', 'local_wspp', $courseidfield . "=" . $courseid));
        if ($tmp = parent :: get_my_groups($client, $sesskey, $uid,$idfield)) {
            $foundOne = false;
            foreach ($tmp as $g) {
                if ($g->courseid == $course->id) {
                    $rres['groups'][] = $this->to_soap($g, 'groupRecord');
                    $foundOne = true;
                }
            }
            if (!$foundOne)
                $rres['groups'][] = $this->error_record('groupRecord', get_string('nothingtodo', 'local_wspp', $courseid));

        } else {
            $rres['groups'][] = $this->error_record('groupRecord', get_string('nogroups', 'local_wspp'));
        }
        return $this->send($rres);
    }

    /**
     * Return's current user Moodle interanl id
     * a convenience function
     * added here for WSHelper to find it and publish it in the WSDL
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @return int
     */
      public function get_my_id($client, $sesskey) {
         return parent :: get_my_id($client, $sesskey);
      }


    /**
    * return courseRecord for one course identified by Moodle's id $info
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course id
    * @return courseRecord[]
    */
    public function get_course_byid($client, $sesskey, $info) {
        return $this->get_courses($client, $sesskey, array (
            $info
        ), 'id');
    }

    /**
    * return courseRecord for one course identified by Moodle's idnumber $info
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course idnumber
    * @return courseRecord[]
    */

    public function get_course_byidnumber($client, $sesskey, $info) {
        return $this->get_courses($client, $sesskey, array (
            $info
        ), 'idnumber');
    }

    /**
    * return an array of course record having $idfield=$info
    * can be used for any criteria
    *   eg: in python proxy.get_courses(a,b,'visible',0)
    *   note that is that case, only admins and courses teachers will get them
    * @see server.soap.class filter_course
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $info  Moodle's  course id to search
    * @param string $idfield  filed used to find the course
    * @return courseRecord[]
    */
    public function get_course($client, $sesskey, $info, $idfield) {
        return $this->get_courses($client, $sesskey, array (
            $info
        ), $idfield);
    }

    /**
    * return an array of users having role $idrole in course $idcourse identified by $idfield
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $idcourse
    * @param string $idfield
    * @param int $roleid
    * @return userRecord[]
    */
    public function get_users_bycourse($client, $sesskey, $idcourse, $idfield = 'idnumber', $idrole = 0) {
        return $this->send($this->to_soap_array(parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole), 'users', 'userRecord', get_string('nousers', 'local_wspp')));

    }

    /**
    * return the count of  users having role $idrole in course $idcourse identified by $idfield
    * Role id number in mdl_roles table. If empty, all roles are matched
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @param int $roleid
    * @return int
    */
    public function count_users_bycourse($client, $sesskey, $idcourse, $idfield = 'idnumber', $idrole = 0) {
        $res = parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole);
        if ($res->error)
            return 0;
        else
            return count($res);

    }

    /**
    * return teachers and non editing teachers of a course $idcourse identified by $idfield
    * rev 1.6.7 role ids 3 and 4 are not anymore hardcoded
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @return userRecord[]
    */
    public function get_teachers($client, $sesskey, $idcourse, $idfield = 'idnumber') {
        $role = ws_get_record('role', 'shortname', 'editingteacher');
        $te = parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, $role->id);
        if (!empty ($te->error)) // cancel any errors if no teachers found
            $te = array ();
        $role = ws_get_record('role', 'shortname', 'teacher');
        $net = parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, $role->id);
        if (!empty ($net->error)) // cancel any errors if no non editing teachers found
            $net = array ();
        return $this->send($this->to_soap_array(array_merge($te, $net), 'users', 'userRecord', get_string('noteachers', 'local_wspp')));
    }

    /**
    * return students of a course $idcourse identified by $idfield
    * rev 1.6.7 role id (4) is not anymore hardcoded
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $courseid
    * @param string $idfield
    * @return userRecord[]
        */

    public function get_students($client, $sesskey, $idcourse, $idfield = 'idnumber') {
        $role = ws_get_record('role', 'shortname', 'student');
        return $this->get_users_bycourse($client, $sesskey, $idcourse, $idfield, $role->id);
    }

    /**
    * return all known roles in Moodle or an array of roleRecord having $idfield equals to $roleid
     * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $roleid
    * @param string $idfield
    * @return roleRecord[]
    */
    public function get_roles($client, $sesskey, $roleid = '', $idfield = '') {
        return $this->send($this->to_soap_array(parent :: get_roles($client, $sesskey, $roleid, $idfield),
          'roles', 'roleRecord', get_string('noroles', 'local_wspp')));
    }

    /**
    * return one roleRecord identified by it's id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param int $roleid
    * @return roleRecord[]
    */
    public function get_role_byid($client, $sesskey, $roleid) {
        return $this->get_roles($client, $sesskey, $roleid, 'id');
    }

    /**
    * return one roleRecord identified by it's shortname
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $rolename
    * @return roleRecord[]
    */
    public function get_role_byname($client, $sesskey, $rolename) {
        return $this->get_roles($client, $sesskey, $rolename, 'shortname');
    }

    /**
    * return categories  identified by
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $catid
    * @param string $idfield
    * @return categoryRecord[]
    */
    public function get_categories($client, $sesskey, $catid = '', $idfield = '') {
        return $this->send($this->to_soap_array(parent :: get_categories($client, $sesskey, $catid, $idfield), 'categories', 'categoryRecord', get_string('nocategories', 'local_wspp')));
    }

    /**
    * return categories Record identified by id
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $catid
    * @return categoryRecord[]
    */
    public function get_category_byid($client, $sesskey, $catid) {
        return $this->get_categories($client, $sesskey, $catid, 'id');
    }

    /**
     * return categories Record identified by name
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $catname
     * @return categoryRecord[]
     */
    public function get_category_byname($client, $sesskey, $catname) {
        return $this->get_categories($client, $sesskey, $catname, 'name');
    }

    /**
     * return courses if category identified by id
     * @param int $client The client session ID.
     * @param string $sesskey The client session key.
     * @param string $catid
     * @return courseRecord[]
     */
    public function get_courses_bycategory($client, $sesskey, $categoryid) {
        return $this->get_courses($client, $sesskey, array (
            $categoryid
        ), 'category');
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $eventtype
     * @param string $ownerid
     * @param string $owneridfield
     * @return eventRecord[]
     */
    public function get_events($client, $sesskey, $eventtype, $ownerid, $owneridfield = 'id') {
        return $this->send($this->to_soap_array(parent :: get_events($client, $sesskey, $eventtype, $ownerid, $owneridfield), 'events', 'eventRecord', get_string('noevents', 'local_wspp')));
    }

    /**
      * @param int $client
      * @param string $sesskey
      * @param string $courseid
      * @param string $courseidfield
      * @param int $limit
      * @return changeRecord[]
      */

    public function get_last_changes($client, $sesskey, $courseid, $idfield = 'idnumber', $limit = 10) {
        return $this->send($this->to_soap_array(parent :: get_last_changes($client, $sesskey, $courseid, $idfield, $limit), 'changes', 'changeRecord', get_string('nochanges', 'local_wspp')));
    }

    /**
     * return all logged actions of user in one course or any course
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $courseid
     * @param string $courseidfield
     * @param int $limit
     * @return activityRecord[]
     */
    public function get_activities($client, $sesskey, $userid, $useridfield = 'idnumber', $courseid = 0, $courseidfield = 'idnumber', $limit = 99) {
        $res = $this->send($this->to_soap_array(
        //array(),  <-- test code 1 empty record return
    parent :: get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, 0), 'activities', 'activityRecord', get_string('noactivities', 'local_wspp')));

        return $res;

    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $courseid
     * @param string $courseidfield
     * @param int $limit
     * @return int
     */
    public function count_activities($client, $sesskey, $userid, $useridfield = 'idnumber', $courseid = '', $courseidfield = 'idnumber', $limit = 0) {
        // save  a lot of memory with flag doCount=1
        return parent :: get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, 1);

    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $assignmentid
     * @param string[] $userids
     * @param string $useridfield
     * @param int $timemodified
     * @param int $zipfiles
     * @return assignmentSubmissionRecord[]
     */
    public function get_assignment_submissions($client, $sesskey, $assignmentid, $userids = array (), $useridfield = 'idnumber', $timemodified = 0, $zipfiles = 1) {
        $res = $this->send($this->to_soap_array(parent :: get_assignment_submissions($client, $sesskey, $assignmentid, $userids, $useridfield, $timemodified, $zipfiles), 'submissions', 'assignmentSubmissionRecord', get_string('nosubmissions', 'local_wspp')));

        return $res;

    }

    /**
    * rev 1.6 add a single course to Moodle

    * @param int $client
    * @param string $sesskey
    * @param courseDatum $coursedatum  (at leat shortname, name, idnumber )
    * @return courseRecord[]  a completed course record inserted in DB or error record
    */

    function add_course($client, $sesskey, $coursedatum) {
        $tmp = new editCoursesInput();
        $coursedatum->action = 'add';
        $tmp->setCourses(array (
            $coursedatum
        ));
        return $this->send($this->to_soap_array(parent :: edit_courses($client, $sesskey, $tmp), 'courses', 'courseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * rev 1.6 delete a single course from Moodle
      * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @return courseRecord[] a completed course record juste deleted from DB or error record
     */
    function delete_course($client, $sesskey, $courseid, $courseidfield = 'idnumber') {
        $course = ws_get_record('course', $courseidfield, $courseid);
        if (!$course)
            return $this->error(get_string('ws_courseunknown', 'local_wspp', $courseidfield . "=" . $courseid));
        $tmp = new editCoursesInput();
        $datum = new courseDatum();
        $datum->setAction('delete');
        $datum->setId($course->id); //set Moodle internal id for edit_courses
        $tmp->setCourses(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_courses($client, $sesskey, $tmp), 'courses', 'courseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param courseDatum $datum
     * @param string $courseidfield  what field in the datum is to be used to find him
     * @return courseRecord[]
     */
     function update_course ($client,$sesskey,$datum,$courseidfield='idnumber') {
        $cid=$datum->$courseidfield;
        $course = ws_get_record('course', $courseidfield,$cid );

        if (!$course)
            return $this->error(get_string('ws_courseunknown', 'local_wspp', $courseidfield . "=" . $cid));
        $tmp = new editCoursesInput();
        $datum->action = 'update';
        $datum->id = $course->id; //set Moodle internal id for edit_courses
        $tmp->setCourses(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_courses($client, $sesskey, $tmp), 'courses', 'courseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
    * @param int $client
    * @param string $sesskey
    * @param userDatum $userdatum
    * @return userRecord[]
    */
    function add_user($client, $sesskey, $userdatum) {
        $tmp = new editUsersInput();
        $userdatum->action = 'add';
        $tmp->setUsers(array (
            $userdatum
        ));
        return $this->send($this->to_soap_array(parent :: edit_users($client, $sesskey, $tmp), 'users', 'userRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
      * rev 1.6 delete a single group from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $userid
      * @param string $useridfield
      * @return userRecord[] a completed user record juste deleted from DB or error record
      */
    function delete_user($client, $sesskey, $userid, $useridfield = 'idnumber') {
        $user = ws_get_record('user', $useridfield, $userid);
        if (!$user)
            return $this->error(get_string('ws_userunknown', 'local_wspp', $useridfield . "=" . $userid));
        $tmp = new editUsersInput();
        $datum = new userDatum();
        $datum->setAction('delete');
        $datum->setId($user->id); //set Moodle internal id for edit_users
        $tmp->setUsers(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_users($client, $sesskey, $tmp), 'users', 'userRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param userDatum $datum
     * @param string $useridfield  what field in the datum is to be used to find him
     * @return userRecord[]
     */
    function update_user($client, $sesskey, $datum, $useridfield = 'idnumber') {
        $uid = $datum-> $useridfield;
        $user = ws_get_record('user', $useridfield, $uid);
        if (!$user)
            return $this->error(get_string('ws_userunknown', 'local_wspp', $useridfield . "=" . $uid));
        $tmp = new editUsersInput();
        $datum->action = 'update';
        $datum->id = $user->id; //set Moodle internal id for edit_users
        $tmp->setUsers(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_users($client, $sesskey, $tmp), 'users', 'userRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param groupingDatum[] $groupings
      * @return groupingRecord[]
      */
    function edit_groupings($client, $sesskey, $groupings) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editGroupingsInput();
            $aux->setGroupings($groupings);
        } else $aux=$groupings;
        return $this->send($this->to_soap_array(parent :: edit_groupings($client, $sesskey, $aux), 'groupings', 'groupingRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param groupDatum $datum
     * @return groupRecord[]
     */
    function add_group($client, $sesskey, $datum) {
        $tmp = new editGroupsInput();
        $datum->action = 'add';
        $tmp->setGroups(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groups($client, $sesskey, $tmp), 'groups', 'groupRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param groupingDatum $datum
     * @return groupingRecord[]
     */
    function add_grouping($client, $sesskey, $datum) {
        $tmp = new editGroupingsInput();
        $datum->action = 'add';
        $tmp->setGroupings(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groupings($client, $sesskey, $tmp), 'groupings', 'groupingRecord', get_string('nothingtodo', 'local_wspp')));
    }

     /**
     * @param int $client
     * @param string $sesskey
     * @param cohortDatum $datum
     * @return cohortRecord[]
     */
    function add_cohort($client, $sesskey, $datum) {
        $tmp = new editCohortsInput();
        $this->debug_output(print_r($datum, true));
        $datum->action = 'add';
        $tmp->setCohorts(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_cohorts($client, $sesskey, $tmp), 'cohorts', 'cohortRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
      * rev 1.6 delete a single group from Moodle
      * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return groupRecord[] a completed group record juste deleted from DB or error record
      */
    function delete_group($client, $sesskey, $id, $idfield = 'id') {
        $old = ws_get_record('groups', $idfield, $id);
        if (!$old)
            return $this->error(get_string('ws_groupunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editGroupsInput();
        $datum = new groupDatum();
        $datum->setAction('delete');
        $datum->setId($old->id); //set Moodle internal id for edit_
        $tmp->setGroups(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groups($client, $sesskey, $tmp), 'groups', 'groupRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
      * rev 1.6 delete a single group from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return groupingRecord[] a completed grouping record juste deleted from DB or error record
      */
    function delete_grouping($client, $sesskey, $id, $idfield = 'id') {
        $old = ws_get_record('groupings', $idfield, $id);
        if (!$old)
            return $this->error(get_string('ws_groupingunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editGroupingsInput();
        $datum = new groupingDatum();
        $datum->setAction('delete');
        $datum->setId($old->id); //set Moodle internal id for edit_
        $tmp->setGroupings(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groupings($client, $sesskey, $tmp), 'groupings', 'groupingRecord', get_string('nothingtodo', 'local_wspp')));
    }

       /**
      * rev 1.6 delete a single cohort from Moodle
       * @param int $client
      * @param string $sesskey
      * @param string $id
      * @param string $idfield
      * @return cohortRecord[] a completed cohort record juste deleted from DB or error record
      */
    function delete_cohort($client, $sesskey, $id, $idfield = 'id') {
        $old = ws_get_record('cohort', $idfield, $id);
        if (!$old)
            return $this->error(get_string('ws_cohortunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editCohortsInput();
        $datum = new cohortDatum();
        $datum->setAction('delete');
        $datum->setId($old->id); //set Moodle internal id for edit_
        $tmp->setCohorts(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_cohorts($client, $sesskey, $tmp), 'cohorts', 'cohortRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
    * rev 1.6 update a single group from Moodle
     * @param int $client
     * @param string $sesskey
     * @param groupDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return groupRecord[]
     */
    function update_group($client, $sesskey, $datum, $idfield = 'id') {
        $id = $datum-> $idfield;
        if (!$old = ws_get_record('groups', $idfield, $id))
            return $this->error(get_string('ws_groupunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editGroupsInput();
        $datum->action = 'update';
        $datum->id = $old->id; //set Moodle internal id for edit_users
        $tmp->setGroups(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groups($client, $sesskey, $tmp),
          'groups', 'groupRecord', get_string('nothingtodo', 'local_wspp')));

    }


    /**
    * rev 1.6 update a single grouping from Moodle
     * @param int $client
     * @param string $sesskey
     * @param groupingDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return groupingRecord[]
     */
    function update_grouping($client, $sesskey, $datum, $idfield = 'id') {
        $id = $datum-> $idfield;
        if (!$old = ws_get_record('groupings', $idfield, $id))
            return $this->error(get_string('ws_groupingunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editGroupingsInput();
        $datum->action = 'update';
        $datum->id = $old->id; //set Moodle internal id for edit_users
        $tmp->setGroupings(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_groupings($client, $sesskey, $tmp),
          'groupings', 'groupingRecord', get_string('nothingtodo', 'local_wspp')));

    }

     /** rev 1.7 update a single cohort from Moodle
     * @param int $client
     * @param string $sesskey
     * @param cohortDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return cohortRecord[]
     */
    function update_cohort($client, $sesskey, $datum, $idfield = 'id') {
        $id = $datum-> $idfield;
        if (!$old = ws_get_record('cohort', $idfield, $id))
            return $this->error(get_string('ws_cohortunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editCohortsInput();
        $datum->action = 'update';
        $datum->id = $old->id; //set Moodle internal id for edit_users
        $tmp->setCohorts(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_cohorts($client, $sesskey, $tmp),
          'cohorts', 'cohortRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $groupingid
     * @return affectRecord
     */
    function affect_group_to_grouping($client, $sesskey, $groupid, $groupingid) {
        return $this->send($this->to_soap(parent :: affect_group_to_grouping($client, $sesskey, $groupid, $groupingid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $groupingid
     * @return affectRecord
     */
    function remove_group_from_grouping($client, $sesskey, $groupid, $groupingid) {
        return $this->send($this->to_soap(parent :: remove_group_from_grouping($client, $sesskey, $groupid, $groupingid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupingid
     * @param int $courseid
     * @return affectRecord
     */
    function affect_grouping_to_course($client, $sesskey, $groupid, $courseid) {
        return $this->send($this->to_soap(parent :: affect_grouping_to_course($client, $sesskey, $groupid, $courseid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    function remove_user_from_group($client, $sesskey, $userid, $groupid) {
        return $this->send($this->to_soap(parent :: remove_user_from_group($client, $sesskey, $userid, $groupid), "affectRecord"));
    }

       /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    function remove_user_from_cohort($client, $sesskey, $userid, $groupid) {
        return $this->send($this->to_soap(parent :: remove_user_from_cohort($client, $sesskey, $userid, $groupid), "affectRecord"));
    }


    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return groupingRecord[]
     */
    function get_all_groupings($client, $sesskey, $fieldname, $fieldvalue) {

        return $this->send($this->to_soap_array(parent :: get_all_groupings($client, $sesskey, $fieldname, $fieldvalue), 'groupings', 'groupingRecord', get_string('nogroupings', 'local_wspp')));
    }

      /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return cohortRecord[]
     */
    function get_all_cohorts($client, $sesskey, $fieldname, $fieldvalue) {
          global $CFG;
         if (!$CFG->wspp_using_moodle20)
           return $this->error(get_string('ws_moodle20only', 'local_wspp'));
        return $this->send($this->to_soap_array(parent :: get_all_cohorts($client, $sesskey, $fieldname, $fieldvalue), 'cohorts', 'cohortRecord', get_string('nocohorts', 'local_wspp')));
    }

    /**
     * add one activity to moodle , must be later assigned to a section
     */

    /**
     * @param int $client
     * @param string $sesskey
     * @param labelDatum $datum
     * @return labelRecord[]
     */
    function add_label($client, $sesskey, $datum) {
        $tmp = new editLabelsInput();
        $datum->action = 'add';
        $tmp->setLabels(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_labels($client, $sesskey, $tmp), 'labels', 'labelRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param forumDatum $datum
     * @return forumRecord[]
     */
    function add_forum($client, $sesskey, $datum) {
        $tmp = new editForumsInput();
        $datum->action = 'add';
        $tmp->setForums(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_forums($client, $sesskey, $tmp), 'forums', 'forumRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param databaseDatum $datum
     * @return databaseRecord[]
     */
    function add_database($client, $sesskey, $datum) {
        $tmp = new editDatabasesInput();
        $datum->action = 'add';
        $tmp->setDatabases(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_databases($client, $sesskey, $tmp), 'databases', 'databaseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param assignmentDatum $datum
     * @return assignmentRecord[]
     */

    function add_assignment($client, $sesskey, $datum) {
        $tmp = new editAssignmentsInput();
        $datum->action = 'add';
        $tmp->setAssignments(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_assignments($client, $sesskey, $tmp), 'assignments', 'assignmentRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param wikiDatum $datum
     * @return wikiRecord[]
     */
    function add_wiki($client, $sesskey, $datum) {
        $tmp = new editWikisInput();
        $datum->action = 'add';
        $tmp->setWikis(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_wikis($client, $sesskey, $tmp), 'wikis', 'wikiRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param pageWikiDatum $datum
     * @return pageWikiRecord[]
     */
    function add_pagewiki($client, $sesskey, $datum) {
        $tmp = new editPagesWikiInput();
        $datum->action = 'add';
        $tmp->setPagesWiki(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_pageswiki($client, $sesskey, $tmp), 'pageswikis', 'pageWikiRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param sectionDatum $datum
     * @return sectionRecord[]
     */
    function add_section($client, $sesskey, $datum) {
        $tmp = new editSectionsInput();
        $datum->action = 'add';
        $tmp->setSections(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_section($client, $sesskey, $tmp), 'sections', 'sectionRecord', get_string('nothingtodo', 'local_wspp')));
    }


    /**
    * rev 1.6 update a single course from Moodle
     * @param int $client
     * @param string $sesskey
     * @param sectionDatum $datum
     * @param string $idfield  what field in the datum is to be used to find him
     * @return sectionRecord[]
     */
    function update_section($client, $sesskey, $datum, $idfield = 'id') {
        $id = $datum-> $idfield;
        if (!$old = ws_get_record('course_sections', $idfield, $id))
            return $this->error(get_string('ws_sectionunknown', 'local_wspp', $idfield . "=" . $id));
        $tmp = new editSectionsInput();
        $datum->action = 'update';
        $datum->id = $old->id; //set Moodle internal id for edit_sections
        $tmp->setSections(array (
            $datum
        ));
        //      $this->debug_output("ES1".print_r($datum,true));
        //  $this->debug_output("ES1".print_r($tmp,true));
        return $this->send($this->to_soap_array(parent :: edit_sections($client, $sesskey, $tmp),
          'sections', 'sectionRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param categoryDatum $datum
     * @return categoryRecord[]
     */
    function add_category($client, $sesskey, $datum) {
        $tmp = new editCategoriesInput();
        $datum->action = 'add';
        $tmp->setCategories(array (
            $datum
        ));
        return $this->send($this->to_soap_array(parent :: edit_categories($client, $sesskey, $tmp), 'categories', 'categoryRecord', get_string('nothingtodo', 'local_wspp')));
    }

    // rev 1.6.4

    //one user

    /**
    * @param int $client
    * @param string $sesskey
    * @param string $userid
    * @param string $useridfield
    * @param profileitemRecord[] $values
    * @return profileitemRecord[]
    */
    function set_user_profile_values($client, $sesskey, $userid, $useridfield, $values) {
        return $this->send($this->to_soap_array(parent :: set_user_profile_values($client, $sesskey, $userid, $useridfield, $values), 'profiles', 'profileitemRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
    * return an array of users having role $idrole in course $idcourse identified by $idfield
    * @param int $client The client session ID.
    * @param string $sesskey The client session key.
    * @param string $profilefieldname
    * @param string $profilefieldvalue
    * @return userRecord[]
    */
    function get_users_byprofile($client, $sesskey, $profilefieldname, $profilefieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_users_byprofile($client, $sesskey, $profilefieldname, $profilefieldvalue), 'users', 'userRecord', get_string('nousers', 'local_wspp')));
    }

        /**
     * rev 1.6.5 added upon request on tstc.edu
     * @param int $client
     * @param string $sesskey
     * @param int $quizid
     * @param string $format
     * @return quizRecord
     */

    function get_quiz($client, $sesskey, $quizid, $format = 'xml') {
        if (empty ($format))
            $format = 'xml';
        return $this->send($this->to_soap(parent :: get_quiz($client, $sesskey, $quizid, $format), 'quizRecord'));
        //return one single record
    }

    /*
    *****************************************************************************************************************************
    *                                                                                                                           *
    *                                                 START LILLE FUNCTIONS                                                     *
    *                                                                                                                           *
    *****************************************************************************************************************************
    */

    /**
       * @param int $client
      * @param string $sesskey
      * @param labelDatum[] $labels
      * @return labelRecord[]
      */
    function edit_labels($client, $sesskey, $labels) {
          // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editLabelsInput();
            $aux->setLabels($labels);
        } else $aux=$labels;

        return $this->send($this->to_soap_array(parent :: edit_labels($client, $sesskey, $aux), 'labels', 'labelRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param groupDatum[] $groups
      * @return groupRecord[]
      */
    function edit_groups($client, $sesskey, $groups) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editGroupsInput();
            $aux->setGroups($groups);
        } else $aux=$groups;
        return $this->send($this->to_soap_array(parent :: edit_groups($client, $sesskey, $aux), 'groups', 'groupRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param assignmentDatum[] $assignments
      * @return assignmentRecord[]
      */
    function edit_assignments($client, $sesskey, $assignments) {
         global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editAssignmentsInput();
            $aux->setAssignments($assignments);
        } else $aux=$assignments;
        return $this->send($this->to_soap_array(parent :: edit_assignments($client, $sesskey, $aux), 'assignments', 'assignmentRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param databaseDatum[] $databases
      * @return databaseRecord[]
      */
    function edit_databases($client, $sesskey, $databases) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editDatabasesInput();
            $aux->setDatabases($databases);
        } else $aux=$databases;
        return $this->send($this->to_soap_array(parent :: edit_databases($client, $sesskey, $aux), 'databases', 'databaseRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param categoryDatum[] $categories
      * @return categoryRecord[]
      */
    function edit_categories($client, $sesskey, $categories) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editCategoriesInput();
            $aux->setCategories($categories);
        } else $aux=$categories;
        return $this->send($this->to_soap_array(parent :: edit_categories($client, $sesskey, $aux), 'categories', 'categoryRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param sectionDatum[] $sections
      * @return sectionRecord[]
      */
    function edit_sections($client, $sesskey, $sections) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editSectionsInput();
            $aux->setSections($sections);
        } else $aux=$sections;
        return $this->send($this->to_soap_array(parent :: edit_sections($client, $sesskey, $aux), 'sections', 'sectionRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param forumDatum[] $forums
      * @return forumRecord[]
      */
    function edit_forums($client, $sesskey, $forums) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editForumsInput();
            $aux->setForums($forums);
        } else $aux=$forums;
        return $this->send($this->to_soap_array(parent :: edit_forums($client, $sesskey, $aux), 'forums', 'forumRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param wikiDatum[] $wikis
      * @return wikiRecord[]
      */
    function edit_wikis($client, $sesskey, $wikis) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editWikisInput();
            $aux->setWikis($wikis);
        } else $aux=$wikis;
        return $this->send($this->to_soap_array(parent :: edit_wikis($client, $sesskey, $aux), 'wikis', 'wikiRecord', get_string('nothingtodo', 'local_wspp')));
    }

    /**
       * @param int $client
      * @param string $sesskey
      * @param pageWikiDatum[] $pageswiki
      * @return pageWikiRecord[]
      */
    function edit_pagesWiki($client, $sesskey, $pagesWiki) {
          global $CFG;
        // rev 1.8.2 important for the new WSDL (parent fonction expect an object of type editXXXXInput in any case
        if (!empty($CFG->wsdl_simplified)) {
            $aux = new editPagesWikiInput();
            $aux->setPagesWiki($pagesWiki);
        } else $aux=$pagesWiki;

        return $this->send($this->to_soap_array(parent :: edit_pagesWiki($client, $sesskey, $aux), 'pagesWiki', 'pageWikiRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $courseid
     * @param int $categoryid
     * @return affectRecord
     */
    function affect_course_to_category($client, $sesskey, $courseid, $categoryid) {
        return $this->send($this->to_soap(parent :: affect_course_to_category($client, $sesskey, $courseid, $categoryid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $labelid
     * @param int $sectionid
     * @return affectRecord
     */
    function affect_label_to_section($client, $sesskey, $labelid, $sectionid) {
        return $this->send($this->to_soap(parent :: affect_label_to_section($client, $sesskey, $labelid, $sectionid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $forumid
     * @param int $sectionid
     * @param int $groupmode
     * @return affectRecord
     */
    function affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode) {
        return $this->send($this->to_soap(parent :: affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $sectionid
     * @param int $courseid
     * @return affectRecord
     */
    function affect_section_to_course($client, $sesskey, $sectionid, $courseid) {
        return $this->send($this->to_soap(parent :: affect_section_to_course($client, $sesskey, $sectionid, $courseid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    function affect_user_to_group($client, $sesskey, $userid, $groupid) {
        return $this->send($this->to_soap(parent :: affect_user_to_group($client, $sesskey, $userid, $groupid), "affectRecord"));
    }

      /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $groupid
     * @return affectRecord
     */
    function affect_user_to_cohort($client, $sesskey, $userid, $groupid) {
        return $this->send($this->to_soap(parent :: affect_user_to_cohort($client, $sesskey, $userid, $groupid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $groupid
     * @param int $courseid
     * @return affectRecord
     */
    function affect_group_to_course($client, $sesskey, $groupid, $courseid) {
        return $this->send($this->to_soap(parent :: affect_group_to_course($client, $sesskey, $groupid, $courseid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $wikiid
     * @param int $sectionid
     * @param int $groupmode
     * @param int $visible
     * @return affectRecord
     */
    function affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible) {
        return $this->send($this->to_soap(parent :: affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $databaseid
     * @param int $sectionid
     * @return affectRecord
     */
    function affect_database_to_section($client, $sesskey, $databaseid, $sectionid) {
        return $this->send($this->to_soap(parent :: affect_database_to_section($client, $sesskey, $databaseid, $sectionid), "affectRecord"));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $assignmentid
     * @param int $sectionid
     * @param int $groupmode
     * @return affectRecord
     */
    function affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode) {
        return $this->send($this->to_soap(parent :: affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode), "affectRecord"));
    }

    /**
    * @param int $client
    * @param string $sesskey
    * @param int $userid
    * @param int $courseid
    * @param string $rolename
    * @return affectRecord
    */
    function affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename) {
        $rest = parent :: affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename);
        return $this->send($this->to_soap($rest, 'affectRecord'));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $pageid
     * @param int $wikiid
     * @return affectRecord
     */
    function affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid) {
        $rest = parent :: affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid);
        return $this->send($this->to_soap($rest, 'affectRecord'));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param int $userid
     * @param int $courseid
     * @param string $rolename
     * @return affectRecord
     */
    function remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename) {
        $rest = parent :: remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename);
        return $this->send($this->to_soap($rest, 'affectRecord'));
    }

    //------------------------------------------------------------------------------------------------------------------------

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return wikiRecord[]
     */

    function get_all_wikis($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_wikis($client, $sesskey, $fieldname, $fieldvalue), 'wikis', 'wikiRecord', get_string('nowikis', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return pageWikiRecord[]
     */
    function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue), 'pageswiki', 'pageWikiRecord', get_string('nowikipages', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return groupRecord[]
     */
    function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_groups($client, $sesskey, $fieldname, $fieldvalue), 'groups', 'groupRecord', get_string('nogroups', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return forumRecord[]
     */
    function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_forums($client, $sesskey, $fieldname, $fieldvalue), 'forums', 'forumRecord', get_string('noforums', 'local_wspp')));
    }

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return labelRecord[]
     */
    function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_labels($client, $sesskey, $fieldname, $fieldvalue), 'labels', 'labelRecord', get_string('nolabels', 'local_wspp')));
    }
    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return assignmentRecord[]
     */
    function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_assignments($client, $sesskey, $fieldname, $fieldvalue), 'assignments', 'assignmentRecord', get_string('noassignments', 'local_wspp')));
    }
    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return databaseRecord[]
     */
    function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_databases($client, $sesskey, $fieldname, $fieldvalue), 'databases', 'databaseRecord', get_string('nodatabases', 'local_wspp')));
    }

    /*
    *****************************************************************************************************************************
    *                                                                                                                           *
    *                                                 END LILLE FUNCTIONS                                                     *
    *                                                                                                                           *
    *****************************************************************************************************************************
    */

    /**
     * @param int $client
     * @param string $sesskey
     * @param string $fieldname
     * @param string $fieldvalue
     * @return quizRecord[]
     */
    function get_all_quizzes($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_quizzes($client, $sesskey, $fieldname, $fieldvalue), 'quizzes', 'quizRecord', get_string('noquizzes', 'local_wspp')));
    }

     /**
      * generic add some role to userid identified by useridfield to courseid identified by couresidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @param string $rolename
     * @param boolean $add
     * @return affectRecord
     */
    private function add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,$rolename,$add) {
	    if (!$course = ws_get_record('course', $courseidfield,$courseid ))
		    return $this->error(get_string('ws_courseunknown', 'local_wspp', $courseidfield . "=" . $courseid));
	    if (! $user = ws_get_record('user', $useridfield, $userid))
		    return $this->error(get_string('ws_userunknown', 'local_wspp', $useridfield . "=" . $userid));
	    if ($add)
		    $rest = parent :: affect_user_to_course($client, $sesskey, $user->id, $course->id,$rolename);
	    else
		    $rest = parent :: remove_user_from_course($client, $sesskey, $user->id, $course->id,$rolename);
	    return $this->send($this->to_soap($rest, 'affectRecord'));
    }

    /**
     * add a editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function add_teacher($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'editingteacher',true);
    }

     /**
     * remove an editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function remove_teacher($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'editingteacher',false);
    }

       /**
     * add a student role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function add_student($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'student',true);
    }

     /**
     * remove a student role  to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function remove_student($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'student',false);
    }

          /**
     * add a non editing teacher role to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function add_noneditingteacher($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'teacher',true);
    }

     /**
     * remove a non editing teacher role  to userid identified by useridfield to courseid identified by courseidfield
     * @param int $client
     * @param string $sesskey
     * @param string $courseid
     * @param string $courseidfield
     * @param string $userid
     * @param string $useridfield
     * @return affectRecord
     */
    public function remove_noneditingteacher($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield) {
    	return $this->add_remove_xxxx($client,$sesskey,$courseid,$courseidfield,$userid,$useridfield,'teacher',false);
    }


      /**
     * add users to a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public function affect_users_to_cohort($client,$sesskey,$cohortid,$cohortidfield,$userids,$useridfield) {
         return $this->send($this->to_soap_array(parent :: affect_users_to_cohort($client,$sesskey,$userids,$useridfield,$cohortid,$cohortidfield,true), 'students', 'enrolRecord', get_string('nothingtodo', 'local_wspp')));

    }

          /**
     * remove users from a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public function remove_users_from_cohort($client,$sesskey,$cohortid,$cohortidfield,$userids,$useridfield) {
            return $this->send($this->to_soap_array(parent :: affect_users_to_cohort($client,$sesskey,$userids,$useridfield,$cohortid,$cohortidfield,false), 'students', 'enrolRecord', get_string('nothingtodo', 'local_wspp')));

    }

     /**
     * add users to a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public function affect_users_to_group($client,$sesskey,$groupid,$groupidfield='id',$userids,$useridfield) {
            return $this->send($this->to_soap_array(parent :: affect_users_to_group($client,$sesskey,$userids,$useridfield,$groupid,$groupidfield,true), 'students', 'enrolRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**
     * remove users from a cohort
     * @param int $client
     * @param string $sesskey
     * @param string[] $userids
     * @param string $useridfield
     * @param string $cohortid
     * @param string $cohortidfield
     * @return enrolRecord[]
     */
    public function remove_users_from_group($client,$sesskey,$groupid,$groupidfield='id',$userids,$useridfield) {
             return $this->send($this->to_soap_array(parent :: affect_users_to_group($client,$sesskey,$userids,$useridfield,$groupid,$groupidfield,false), 'students', 'enrolRecord', get_string('nothingtodo', 'local_wspp')));

    }

     /**  rev 1.8
     * get all discussions from a forum
     * @param int $client
     * @param string $sesskey
     * @param int $forumid
     * @param int $limit
     * @return forumDiscussionRecord[]
     */
    public function get_forum_discussions($client,$sesskey,$forumid,$limit) {
             return $this->send($this->to_soap_array(parent :: get_forum_discussions($client,$sesskey,$forumid
            ), 'forumDiscussions', 'forumDiscussionRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**  rev 1.8
     * get all post from a discussion in a forum
     * @param int $client
     * @param string $sesskey
     * @param int $discussionid
     * @param int $limit
     * @return forumPostRecord[]
     */
    public function get_forum_posts($client,$sesskey,$discussionid,$limit) {
             return $this->send($this->to_soap_array(parent :: get_forum_posts($client,$sesskey,$discussionid
            ), 'forumPosts', 'forumPostRecord', get_string('nothingtodo', 'local_wspp')));

    }

    /**  rev 1.8
     * add a discussion in a forum
     * @param int $client
     * @param string $sesskey
     * @param int $forumid
     * @param forumDiscussionDatum $discussion
     * @return forumDiscussionRecord[]
     */

    public function forum_add_discussion ($client,$sesskey,$forumid,$discussion) {
           return $this->send($this->to_soap_array(parent :: forum_add_discussion($client,$sesskey,$forumid,$discussion
            ), 'forumDiscussions', 'forumDiscussionRecord', get_string('nothingtodo', 'local_wspp')));

    }


      /**  rev 1.8
     * add a reply to a post/discussion in a forum
     * @param int $client
     * @param string $sesskey
     * @param int $parenttid
     * @param forumPostDatum $post
     * @return forumPostRecord[]
     */

    public function forum_add_reply ($client,$sesskey,$parentid,$post) {
          return $this->send($this->to_soap_array(parent :: forum_add_reply($client,$sesskey,$parentid,$post
            ), 'forumPosts', 'forumPostRecord', get_string('nothingtodo', 'local_wspp')));
    }

      /**  rev 1.8
     * send an instant message to user identified if (userid,useridfield)
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @param string $message
     * @return affectRecord
     */

    public function message_send ($client,$sesskey,$userid,$useridfield,$message) {
          return $this->send($this->to_soap(parent :: message_send($client,$sesskey,$userid,$useridfield,$message
            ), 'affectRecord'));


    }

         /**  rev 1.8
     * retrieve all contacts of user identified by userid
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @return contactRecord[]
     */

    public function get_message_contacts ($client,$sesskey,$userid,$useridfield) {
              return $this->send($this->to_soap_array(parent :: get_message_contacts ($client,$sesskey,$userid,$useridfield
            ), 'contacts', 'contactRecord', get_string('nocontacts', 'local_wspp')));
    }

           /**  rev 1.8
     * retrieve all unread user's messages
     * @param int $client
     * @param string $sesskey
     * @param string $userid
     * @param string $useridfield
     * @return messageRecord[]
     */

    public function get_messages ($client,$sesskey,$userid,$useridfield) {
              return $this->send($this->to_soap_array(parent :: get_messages ($client,$sesskey,$userid,$useridfield
            ), 'messages', 'messageRecord', get_string('nomessages', 'local_wspp')));
    }


     /**  rev 1.8
     * retrieve all unread user's messages
     * @param int $client
     * @param string $sesskey
     * @param string $useridto
     * @param string $useridtofield
     * @param string $useridfrom
     * @param string $useridfromfield
     * @return messageRecord[]
     */

    public function get_messages_history ($client,$sesskey,$useridto,$useridtofield,$useridfrom,$useridfromfield) {
            return $this->send($this->to_soap_array(parent :: get_messages_history ($client,$sesskey,
               $useridto,$useridtofield,$useridfrom,$useridfromfield
            ), 'messages', 'messageRecord', get_string('nomessages', 'local_wspp')));
    }



   /**  rev 1.8.3
     * retrieve a file resource by it's id
     * @param int $client
     * @param string $sesskey
     * @param int $resourceid
     * @return fileRecord
     */

    public function get_resourcefile_byid ($client,$sesskey,$resourceid) {
            return $this->send($this->to_soap(parent :: get_resourcefile_byid ($client,$sesskey,$resourceid),
            'fileRecord'));
    }





}
?>
