<?php
// $Id: mdl_soapserver.class.php,v 1.5.4  2007/05/08 22:04:25 pp Exp $

/**
 * class for SOAP protocol-specific server layer. PHP 5 ONLY (may throw an exception !)
 *
 * @package Web Services
 * @version $Id: mdl_soapserver.class.php,v 1.5 2007/04/26 22:04:25 pp Exp $
 * @author Open Knowledge Technologies - http://www.oktech.ca/
 * @author Justin Filip <jfilip@oktech.ca>  v 1.4
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.5, 1.6
 */




// base class that performs data extraction/injection
require_once ('server.class.php');

// list of required classes for input/output data
require_once ('MoodleWS.php');

//define('DEBUG',true);

if (DEBUG)
	ini_set('soap.wsdl_cache_enabled', '0'); // no caching by php in debug mode)

class mdl_soapserver extends server {

	/**
	 * Constructor method.
	 *
	 * @param none
	 * @return none
	 */
	function mdl_soapserver() {
        global $CFG;
		/// Necessary for processing any DB upgrades.
		parent :: server();

		$this->debug_output('    Version: ' . $this->version);
		$this->debug_output('    Session Timeout: ' . $this->sessiontimeout);
        //turn off output of calls to debugging() that messup the XML
        // see lib/gradelib.php
        $CFG->debug=0;

		ob_start(); //rev 1.6 buffer all Moodle ouptuts see send function
	}

	/**
	 * if Moodle has complained some way return content of ob_buffer
	 * else pass the real result (from to_soap or to_soaparray ) to be sent in XML
     * must be called at every return to client
	 */

	function send($result) {
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
	* @return An error message string.
	*/
	function error($msg) {
		parent :: error($msg); //log in error msg
		throw new SoapFault("Server", $msg);
	}

	/** since SOAP requires all attributes fields to be filled, even in case of error
	* this function return a "blank array", with error attribute set to $errMsg
	* className is the name of the returned class built with our wsdl2php utility against our WSDL file
	    */

	function blank_array($className) {
		if (class_exists($className)) {
			$res = new $className ();
			return get_object_vars($res); // convert to array
		} else
			// throw a fatal exception SoapFault
			$this->error("internal error :class $className not found !");
	}

	function error_record($className, $errMsg) {
		$res = $this->blank_array($className);
		$res['error'] = $errMsg;
		return $res;
	}

	/**
	* return a SOAP ready array with filled in attributes from a Moodle object
	* or a blank array with attribute error set
	*/
	function to_soap($res, $className) {

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

	function to_soap_array($res, $keyName, $className, $emptyMsg) {
		$return = array ();
		if (!$res || !is_array($res) || (count($res) == 0))
			$return[$keyName][] = $this->error_record($className, $emptyMsg);
		else {
			foreach ($res as $r) {
				$return[$keyName][] = $this->to_soap($r, $className);
			}
		}
		return $return;

	}

	/**  =====  OVERRIDE SERVER METHODS NEEDING SOAP-SPECIFIC HANDLING  ======  **/

	/**
	 * Edit user records (add/update/delete).
	 * UNTESTED PP
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $users An array of user records (objects or arrays) for editing
	 *                     (including opertaion to perform).
	 * @return array An array of user objects.
	 */
	public function edit_users($client, $sesskey, $users) {
		return $this->send($this->to_soap_array(parent :: edit_users($client, $sesskey, $users),
         'users', 'userRecord', get_string('nothingtodo','wspp')));
	}

	/**
	 * Find and return a list of user records.
	 * OK PP tested with php5 5 and python clients
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $userids An array of input user id values. If empty, all users are returned
	 * @param string $idfield : the id field to use for searching users ('id', 'idnumber' ...)
	 *    not necessarly unique ...
	 * examples in Python :
	 *       proxy.get_users(a,b,['astrid','pguy','toto'],'username')
	 *       proxy.get_users(a,b,['alexis'],'firstname')
	 *       proxy.get_users(a,b,['alexis','astrid'],'firstname')
	 *       proxy.get_users(a,b,[1],'deleted')
	 * @return array An array of user records.
	 */
	public function get_users($client, $sesskey, $userids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_users($client, $sesskey, $userids, $idfield),
         'users', 'userRecord',get_string('nousers','wspp')));
	}

	/**
	 * Find Edit course records (add/update/delete).
	 * UNTESTED PP
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $courseids An array of course records (objects or arrays) for
	 *                         editing (including operation to perform).
	 * @return array An array of course records.
	 */
	public function edit_courses($client, $sesskey, $courses) {
		return $this->send($this->to_soap_array(parent :: edit_courses($client, $sesskey, $courses),
       'courses', 'courseRecord', get_string('nothingtodo','wspp')));
	}

	/**
	 * Find and return a list of course records.
	 * OK PP tested with php5 5 and python clients
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param array $courseids An array of input course id values to search for. If empty return all courses
	 * @param string $idfield : the field used to identify courses
	 * @return array An array of resource records.
	 */
	public function get_courses($client, $sesskey, $courseids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_courses($client, $sesskey, $courseids, $idfield),
         'courses', 'courseRecord', get_string('nocourses','wspp')));
	}

	/**
	* Find and return a list of resources within one or several courses.
	* TODO cast returned data to more specific types
	* currently return only a "generic description"
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $courseids An array of input course id values to search for. If empty return all ressources
	* @param string $idfield : the field used to identify courses
	* @param string $type : resource type i.e. forum, wiki, assignment ...
	* @return array An array of type records.
	*/
	public function get_instances_bytype($client, $sesskey, $courseids, $idfield = 'idnumber', $type = 'resource') {
		return $this->send($this->to_soap_array(parent :: get_instances_bytype($client, $sesskey, $courseids, $idfield, $type),
         'resources', 'resourceRecord', get_string('noressources','wspp') .$type ));
	}

	/**
	* Find and return a list of activities within one or several courses.
	* OK PP tested with php5 5 and python clients
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param array $courseids An array of input course id values to search for. If empty return all ressources
	* @param string $idfield : the field used to identify courses
	* @return array An array of resource records.
	*/
	public function get_resources($client, $sesskey, $courseids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_resources($client, $sesskey, $courseids, $idfield),
         'resources', 'resourceRecord', get_string('noressources','wspp')));
	}

	/**
	    * Find and return a list of sections within one or several courses.
	    * OK PP tested with php5 5 and python clients
	    * @param int $client The client session ID.
	    * @param string $sesskey The client session key.
	    * @param array $courseids An array of input courses id values to search for. If empty return all sections
	    * @param string $idfield : the field used to identify courses
	    * @return array An array of section records.
	    */
	public function get_sections($client, $sesskey, $courseids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_sections($client, $sesskey, $courseids, $idfield),
         'sections', 'sectionRecord', get_string('nosections','wspp') ));
	}

	/**
	 * Enrol users as a student in the given course.
	 * prerequisite : corresponding students records MUST exist in Moodle
	 * OK PP tested with php5 5 and python clients
	 * @param int $client The client session ID.
	 * @param string $sesskey The client session key.
	 * @param string $courseid The course ID number to enrol students in. (caution idnumber, not Moodle id)
	 * @param array $userids An array of input user idnumber values for enrolment.
	 * @param string $idfield student identifier, default idnumber
	 * @return array Return data (user_student records) to be converted into a
	 *               specific data format for sending to the client.
	 */
	public function enrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: affect_role_incourse($client, $sesskey, 'Student', $courseid, $courseidfield, $userids, $idfield, true),
         'students', 'enrolRecord',get_string('nothingtodo','wspp')));

	}

	public function unenrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: affect_role_incourse($client, $sesskey, 'Student', $courseid, $courseidfield, $userids, $idfield, false),
          'students', 'enrolRecord', "no student to unenrol in course $courseid "));
	}

	/**
	     * Find and return student grades for currently enrolled courses  (moodle 1.9)
	     *
	     * @uses $CFG
	     * @param int $client The client session ID.
	     * @param string $sesskey The client session key.
	     * @param string $userid The ATIStudentID number of the student.
	     * @param string $courseids Array of course idnumber
	     * @return  student grades
	     *
	*/

	public function get_grades($client, $sesskey, $userid, $useridfield = 'idnumber', $courseids, $courseidfield = "idnumber") {

		return $this->send($this->to_soap_array(parent :: get_grades($client, $sesskey, $userid, $useridfield, $courseids, $courseidfield),
'grades', 'gradeRecord', get_string('nogradesfor','wspp',$userid )));

	}

	public function get_user_grades($client, $sesskey, $userid, $idfield = "idnumber") {

		return $this->send($this->to_soap_array(parent :: get_user_grades($client, $sesskey, $userid, $idfield), 'grades', 'gradeRecord', "no grades  found for user $userid"));

	}

	public function get_course_grades($client, $sesskey, $courseid, $idfield = "idnumber") {

		return $this->send($this->to_soap_array(parent :: get_course_grades($client, $sesskey, $courseid, $idfield),
         'grades', 'gradeRecord',get_string('nogradesin','wspp',$courseid)));

	}

	/**
	*   get one user record with idfield=userinfo.
	*   may return several users records if idfield is not a key
	*   eg. proxy.get_user(a,b,'alexis','firstname')
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
	* @param int $uid (optional) Moodle's id of user. If absent, uses current session user id
	* @param string $sort (optional). If absent use parent's default (by fullname)
	* @return array Return data (course record) to be converted into a specific
	*               data format for sending to the client.
	*/

	private function _get_mycourses_by($client, $sesskey, $uinfo, $idfield, $sort) {
		return $this->send($this->to_soap_array(parent :: get_my_courses($client, $sesskey, $uinfo, $idfield, $sort),
     'courses', 'courseRecord', get_string('nocourses','wspp')));

	}

	public function get_my_courses($client, $sesskey, $uid = '', $sort = '') {
		return $this->_get_mycourses_by($client, $sesskey, $uid, 'id', $sort);
	}

	public function get_my_courses_byusername($client, $sesskey, $uid = '', $sort = '') {
		return $this->_get_mycourses_by($client, $sesskey, $uid, 'username', $sort);
	}

	public function get_my_courses_byidnumber($client, $sesskey, $uid = '', $sort = '') {
		return $this->_get_mycourses_by($client, $sesskey, $uid, 'idnumber', $sort);
	}

	/**
	* Get an user record from it's login name
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $userinfo  Moodle's login of user.
		* @return array Return data (user  record) to be converted into a specific
	*               data format for sending to the client.
	*/
	public function get_user_byusername($client, $sesskey, $userinfo) {
		return $this->get_user($client, $sesskey, $userinfo, 'username');
	}

	/**
	* Get an user record from it's id number (an optional info in Moodle)
	* @param int $client The client session ID.
	* @param string $sesskey The client session key.
	* @param int $userinfo  Moodle's id number .
	* @return array Return data (user  record) to be converted into a specific
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
	 * @return array Return data (user  record) to be converted into a specific
	 *               data format for sending to the client.
	 */

	public function get_user_byid($client, $sesskey, $userinfo) {
		return $this->get_user($client, $sesskey, $userinfo, 'id');
	}

	/**
	* return the list of groups of course identified by courseid
	* @param string $courseid the course identifier
	* @param string $idfield  the course identifier field, defaut = idnumber
	* @return array of groupRecord
	*/
	public function get_groups_bycourse($client, $sesskey, $courseid, $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_groups_bycourse($client, $sesskey, $courseid, $idfield),
          'groups', 'groupRecord', get_string('nogroupsin','wspp',$courseid)));
	}

	/**
	* return one groupRecord  identified by Moodle's id
	*/
	public function get_group_byid($client, $sesskey, $groupid) {
		return $this->get_groups($client, $sesskey, array (
			$groupid
		), 'id', 0);
	}

	/**
	* return one or several groupRecord for groups having name $name
	* and (optionally) belonging to course $courseid
	*/
	public function get_groups_byname($client, $sesskey, $groupname, $courseid = 0) {
		return $this->get_groups($client, $sesskey, array (
			$groupname
		), 'name', $courseid);
	}

	/**
	* return members of group identified by $groupeid (Moodle id )
	*/

	public function get_group_members($client, $sesskey, $groupid,$groupidfield='id') {

		return $this->send($this->to_soap_array(parent :: get_group_members($client, $sesskey, $groupid,$groupidfield),
         'users', 'userRecord', get_string('nousers','wspp')));

	}

    /**
    * return members of group identified by $groupeid (Moodle id )
    */

    public function get_grouping_members($client, $sesskey, $groupid,$groupidfield='id') {

        return $this->send($this->to_soap_array(parent :: get_grouping_members($client, $sesskey, $groupid,$groupidfield),
         'users', 'userRecord', get_string('nousers','wspp')));

    }

	/**
	* return groups to which user $uid belongs to
	* if $uid is empty, use current logged in user.
	* otherwise, current logged in user must be admin to fetch data
	*/
	public function get_my_groups($client, $sesskey, $uid = '', $idfield = 'idnumber') {
		return $this->send($this->to_soap_array(parent :: get_my_groups($client, $sesskey, $uid, $idfield),
        'groups', 'groupRecord', get_string('nogroups','wspp')));
	}

	/**
	* Return user's $uid group(s)  in course identified by $courseid
	* @param $uid . User's Moodle id. If empty, use current logged in user.
	* @param $courseid course id
	*/

	public function get_my_group($client, $sesskey, $uid, $courseid, $courseidfield = 'id') {
		$rres = array ();
		if ($tmp = parent :: get_my_groups($client, $sesskey, $uid)) {
			$foundOne = false;
			foreach ($tmp as $g) {
				if ($g->courseid == $courseid) {
					$rres['groups'][] = $this->to_soap($g, 'groupRecord');
					$foundOne = true;
				}
			}
			if (!$foundOne)
				$rres['groups'][] = $this->error_record('groupRecord',get_string('nothingtodo','wspp',$courseid));

		} else {
			$rres['groups'][] = $this->error_record('groupRecord', get_string('nogroups','wspp'));
		}
		return $this->send($rres);
	}

	/**
	* return courseRecord for one course identified by Moodle's id $info
	*/

	public function get_course_byid($client, $sesskey, $info) {
		return $this->get_courses($client, $sesskey, array (
			$info
		), 'id');
	}

	/**
	    * return courseRecord for one course identified by idnumber $info
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
	*/
	public function get_course($client, $sesskey, $info, $idfield) {
		return $this->get_courses($client, $sesskey, array (
			$info
		), $idfield);
	}

	/**
	* return an array of users having role $idrole in course $idcourse identified by $idfield
		* @param integer $idrole. Role id number in mdl_roles table. If empty, all roles are matched
	*/

	public function get_users_bycourse($client, $sesskey, $idcourse, $idfield = 'idnumber', $idrole = 0) {
		return $this->send($this->to_soap_array(parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole),
          'users', 'userRecord', get_string('nousers','wspp')));

	}

	/**
	* return the count of  users having role $idrole in course $idcourse identified by $idfield
	* @param integer $idrole. Role id number in mdl_roles table. If empty, all roles are matched
	* could be moved in server.class since no type conversion is required (return integer)
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
	*/
	public function get_teachers($client, $sesskey, $idcourse, $idfield = 'idnumber') {
		$te = parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, 3);
		if (!empty ($te->error)) // cancel any errors if no teachers found
			$te = array ();
		$net = parent :: get_users_bycourse($client, $sesskey, $idcourse, $idfield, 4);
		if (!empty ($net->error)) // cancel any errors if no non editing teachers found
			$net = array ();
		return $this->send($this->to_soap_array(array_merge($te, $net), 'users', 'userRecord',
        get_string('noteachers','wspp')));
	}

	/**
	    * return students of a course $idcourse identified by $idfield
	    */

	public function get_students($client, $sesskey, $idcourse, $idfield = 'idnumber') {
		return $this->get_users_bycourse($client, $sesskey, $idcourse, $idfield, 5);
	}

	/**
	* return all known roles in Moodle or an array of roleRecord having $idfield equals to $roleid
	*/
	public function get_roles($client, $sesskey, $roleid = '', $idfield = '') {
		return $this->send($this->to_soap_array(parent :: get_roles($client, $sesskey, $roleid, $idfield),
         'roles', 'roleRecord', get_string('noroles','wspp')));
	}

	/**
	* return one roleRecord identified by it's id
	*/
	public function get_role_byid($client, $sesskey, $roleid) {
		return $this->get_roles($client, $sesskey, $roleid, 'id');
	}

	/**
	   * return one roleRecord identified by it's name
	   */

	public function get_role_byname($client, $sesskey, $rolename) {
		return $this->get_roles($client, $sesskey, $rolename, 'shortname');
	}

	public function get_categories($client, $sesskey, $catid = '', $idfield = '') {
		return $this->send($this->to_soap_array(parent :: get_categories($client, $sesskey, $catid, $idfield),
              'categories', 'categoryRecord', get_string('nocategories','wspp')));
	}

	public function get_category_byid($client, $sesskey, $catid) {
		return $this->get_categories($client, $sesskey, $catid, 'id');
	}

	public function get_category_byname($client, $sesskey, $catname) {
		return $this->get_categories($client, $sesskey, $catname, 'name');
	}

	public function get_courses_bycategory($client, $sesskey, $categoryid) {
		return $this->get_courses($client, $sesskey, array (
			$categoryid
		), 'category');
	}

	public function get_events($client, $sesskey, $eventtype, $ownerid,$owneridfield='id') {
		return $this->send($this->to_soap_array(parent :: get_events($client, $sesskey, $eventtype, $ownerid,$owneridfield),
        'events', 'eventRecord',get_string('noevents','wspp')));
	}

	public function get_last_changes($client, $sesskey, $courseid, $idfield = 'idnumber', $limit = 10) {
		return $this->send($this->to_soap_array(parent :: get_last_changes($client, $sesskey, $courseid, $idfield, $limit),
        'changes', 'changeRecord',get_string('nochanges','wspp')));
	}

	public function get_activities($client, $sesskey, $userid, $useridfield = 'idnumber', $courseid = 0, $courseidfield = 'idnumber', $limit = 99) {
		$res = $this->send($this->to_soap_array(
		//array(),  <-- test code 1 empty record return
	parent :: get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, 0),
     'activities', 'activityRecord',get_string('noactivities','wspp')));

		return $res;

	}

	public function count_activities($client, $sesskey, $userid, $useridfield = 'idnumber', $courseid = 0, $courseidfield = 'idnumber', $limit = 0) {
		// save  a lot of memory with flag doCount=1
		return parent :: get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit, 1);

	}



      /**
     * rev 1.6 add a single course to Moodle
     * @param CourseDatum $course  (at leat shortname, name, idnumber )
     * @return a completed course record inserted in DB or error record
     */

    function add_course ($client,$sesskey,$coursedatum) {
        $tmp= new  editCoursesInput();
        $coursedatum->action='add';
        $tmp->setCourses(array($coursedatum));
        return $this->send($this->to_soap_array(parent::edit_courses($client,$sesskey,$tmp),
        'courses', 'courseRecord', get_string('nothingtodo','wspp')));
    }


    /**
     * rev 1.6 delete a single course from Moodle
     * @param string $courseid
     * @param string $courseidfield)
     * @return a completed course record juste deleted from DB or error record
     */

     function delete_course ($client,$sesskey,$courseid,$courseidfield='idnumber') {
        $course = get_record('course', $courseidfield, $courseid);
        if (!$course)
            return $this->error(get_string('ws_courseunknown','wspp',$courseidfield."=".$courseid ));
        $tmp= new  editCoursesInput();
        $datum=new courseDatum();
        $datum->setAction('delete');
        $datum->setId ($course->id);  //set Moodle internal id for edit_courses
        $tmp->setCourses(array($datum));
        return $this->send($this->to_soap_array(parent::edit_courses($client,$sesskey,$tmp),
        'courses', 'courseRecord', get_string('nothingtodo','wspp')));
    }

     /**
     * rev 1.6 update a single course from Moodle
     * @param string $datum new  course data
     * @param string $courseidfield)
     * @return a completed course record just updated  from DB or error record
     */

     function update_course ($client,$sesskey,$datum,$courseidfield='idnumber') {
        $cid=$datum->$courseidfield;
        $course = get_record('course', $courseidfield,$cid );
        if (!$course)
            return $this->error(get_string('ws_courseunknown','wspp',$courseidfield."=".$cid ));
        $tmp= new  editCoursesInput();
        $datum->action='update';
        $datum->id=$course->id;    //set Moodle internal id for edit_courses
        $tmp->setCourses(array($datum));
        return $this->send($this->to_soap_array(parent::edit_courses($client,$sesskey,$tmp),
        'courses', 'courseRecord', get_string('nothingtodo','wspp')));
    }



   /**
     * rev 1.6 add a single course to Moodle
     * @param CourseDatum $course  (at leat shortname, name, idnumber )
     * @return a completed course record inserted in DB or error record
     */

    function add_user ($client,$sesskey,$userdatum) {
        $tmp= new  editUsersInput();
        $userdatum->action='add';
        $tmp->setUsers(array($userdatum));
        return $this->send($this->to_soap_array(parent::edit_users($client,$sesskey,$tmp),
        'users', 'userRecord', get_string('nothingtodo','wspp')));
    }




     function delete_user ($client,$sesskey,$userid,$useridfield='idnumber') {
        $user = get_record('user', $useridfield, $userid);
        if (!$user)
            return $this->error(get_string('ws_userunknown','wspp',$useridfield."=".$uid ));
        $tmp= new  editUsersInput();
        $datum=new userDatum();
        $datum->setAction('delete');
        $datum->setId ($user->id);  //set Moodle internal id for edit_users
        $tmp->setUsers(array($datum));
        return $this->send($this->to_soap_array(parent::edit_users($client,$sesskey,$tmp),
        'users', 'userRecord', get_string('nothingtodo','wspp')));
    }

    function update_user ($client,$sesskey,$datum,$useridfield='idnumber') {
           $uid=$datum->$useridfield;
        $user = get_record('user', $useridfield, $uid);
        if (!$user)
            return $this->error(get_string('ws_userunknown','wspp',$useridfield."=".$uid ));
        $tmp= new  editUsersInput();
        $datum->action='update';
        $datum->id=$user->id;  //set Moodle internal id for edit_users
        $tmp->setUsers(array($datum));
        return $this->send($this->to_soap_array(parent::edit_users($client,$sesskey,$tmp),
        'users', 'userRecord', get_string('nothingtodo','wspp')));
    }



    function edit_groupings($client, $sesskey, $groupings) {
    return $this->send($this->to_soap_array(parent :: edit_groupings($client, $sesskey, $groupings),
         'groupings', 'groupingRecord', get_string('nothingtodo','wspp')));
    }


    function add_group ($client,$sesskey,$datum) {
        $tmp= new  editGroupsInput();
        $datum->action='add';
        $tmp->setGroups(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groups($client,$sesskey,$tmp),
        'groups', 'groupRecord', get_string('nothingtodo','wspp')));
    }

    function add_grouping ($client,$sesskey,$datum) {
        $tmp= new  editGroupingsInput();
        $datum->action='add';
        $tmp->setGroupings(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groupings($client,$sesskey,$tmp),
        'groupings', 'groupingRecord', get_string('nothingtodo','wspp')));
    }


  function delete_group ($client,$sesskey,$id,$idfield='id') {
        $old = get_record('groups', $idfield, $id);
        if (!$old)
            return $this->error(get_string('ws_groupunknown','wspp',$idfield."=".$id ));
        $tmp= new  editGroupsInput();
        $datum=new groupDatum();
        $datum->setAction('delete');
        $datum->setId ($old->id);  //set Moodle internal id for edit_
        $tmp->setGroups(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groups($client,$sesskey,$tmp),
        'groups', 'groupRecord', get_string('nothingtodo','wspp')));
    }

    function delete_grouping ($client,$sesskey,$id,$idfield='id') {
        $old = get_record('groupings', $idfield, $id);
        if (!$old)
            return $this->error(get_string('ws_groupingunknown','wspp',$idfield."=".$id ));
        $tmp= new  editGroupingsInput();
        $datum=new groupingDatum();
        $datum->setAction('delete');
        $datum->setId ($old->id);  //set Moodle internal id for edit_
        $tmp->setGroupings(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groupings($client,$sesskey,$tmp),
        'groupings', 'groupingRecord', get_string('nothingtodo','wspp')));
    }

     function update_group ($client,$sesskey,$datum,$idfield='id') {
        $id=$datum->$idfield;
        if(!$old = get_record('groups', $idfield, $id))
            return $this->error(get_string('ws_groupunknown','wspp',$idfield."=".$id ));
        $tmp= new  editGroupsInput();
        $datum->action='update';
        $datum->id=$old->id;  //set Moodle internal id for edit_users
        $tmp->setGroups(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groups($client,$sesskey,$tmp),
        'groups', 'groupRecord', get_string('nothingtodo','wspp')));
    }

       function update_grouping ($client,$sesskey,$datum,$idfield='id') {
        $id=$datum->$idfield;
       if (!$old = get_record('groupings', $idfield, $id))
            return $this->error(get_string('ws_groupingunknown','wspp',$idfield."=".$id ));
        $tmp= new  editGroupingsInput();
        $datum->action='update';
        $datum->id=$old->id;  //set Moodle internal id for edit_users
        $tmp->setGroupings(array($datum));
        return $this->send($this->to_soap_array(parent::edit_groupings($client,$sesskey,$tmp),
        'groupings', 'groupingRecord', get_string('nothingtodo','wspp')));
    }



    function affect_group_to_grouping($client, $sesskey, $groupid, $groupingid) {
        return $this->send($this->to_soap(parent :: affect_group_to_grouping($client, $sesskey, $groupid, $groupingid), "affectRecord"));
    }

     function remove_group_from_grouping($client, $sesskey, $groupid, $groupingid) {
        return $this->send($this->to_soap(parent :: remove_group_from_grouping($client, $sesskey, $groupid, $groupingid), "affectRecord"));
    }


    function affect_grouping_to_course($client, $sesskey, $groupid, $courseid) {
        return $this->send($this->to_soap(parent :: affect_grouping_to_course($client, $sesskey, $groupid, $courseid),
     "affectRecord"));
    }


    function remove_user_from_group($client, $sesskey, $userid,$groupid) {
        return $this->send($this->to_soap(parent :: remove_user_from_group($client, $sesskey, $userid,$groupid),
     "affectRecord"));
    }

    function get_all_groupings($client, $sesskey, $fieldname, $fieldvalue) {
        return $this->send($this->to_soap_array(parent :: get_all_groupings($client, $sesskey, $fieldname, $fieldvalue),
            'groupings', 'groupingRecord', get_string('nogroupings','wspp')));
    }


/**
 * add one activity to moodle , must be later assigned to a section
 */

    function add_label($client, $sesskey, $datum) {
       $tmp= new  editLabelsInput();
        $datum->action='add';
        $tmp->setLabels(array($datum));
        return $this->send($this->to_soap_array(parent::edit_labels($client,$sesskey,$tmp),
        'labels', 'labelRecord', get_string('nothingtodo','wspp')));
    }

    function add_forum($client, $sesskey, $datum) {
       $tmp= new  editForumsInput();
        $datum->action='add';
        $tmp->setForums(array($datum));
        return $this->send($this->to_soap_array(parent::edit_forums($client,$sesskey,$tmp),
        'forums', 'forumRecord', get_string('nothingtodo','wspp')));
    }

    function add_database($client, $sesskey, $datum) {
       $tmp= new  editDatabasesInput();
        $datum->action='add';
        $tmp->setDatabases(array($datum));
        return $this->send($this->to_soap_array(parent::edit_databases($client,$sesskey,$tmp),
        'databases', 'databaseRecord', get_string('nothingtodo','wspp')));
    }

     function add_assignment($client, $sesskey, $datum) {
       $tmp= new  editAssignmentsInput();
        $datum->action='add';
        $tmp->setAssignments(array($datum));
        return $this->send($this->to_soap_array(parent::edit_assignments($client,$sesskey,$tmp),
        'assignments', 'assignmentRecord', get_string('nothingtodo','wspp')));
    }

     function add_wiki($client, $sesskey, $datum) {
       $tmp= new  editWikisInput();
        $datum->action='add';
        $tmp->setWikis(array($datum));
        return $this->send($this->to_soap_array(parent::edit_wikis($client,$sesskey,$tmp),
        'wikis', 'wikiRecord', get_string('nothingtodo','wspp')));
    }

    function add_pagewiki($client, $sesskey, $datum) {
       $tmp= new  editPagesWikiInput();
        $datum->action='add';
        $tmp->setPagesWiki(array($datum));
        return $this->send($this->to_soap_array(parent::edit_pageswiki($client,$sesskey,$tmp),
        'pageswikis', 'pageWikiRecord', get_string('nothingtodo','wspp')));
    }


     function add_section($client, $sesskey, $datum) {
       $tmp= new  editSectionsInput();
        $datum->action='add';
        $tmp->setSections(array($datum));
        return $this->send($this->to_soap_array(parent::edit_section($client,$sesskey,$tmp),
        'sections', 'sectionRecord', get_string('nothingtodo','wspp')));
    }

    function update_section ($client,$sesskey,$datum,$idfield='id') {
        $id=$datum->$idfield;
        if(!$old = get_record('course_sections', $idfield, $id))
            return $this->error(get_string('ws_sectionunknown','wspp',$idfield."=".$id ));
        $tmp= new  editSectionsInput();
        $datum->action='update';
        $datum->id=$old->id;  //set Moodle internal id for edit_sections
        $tmp->setSections(array($datum));
       //      $this->debug_output("ES1".print_r($datum,true));
       //  $this->debug_output("ES1".print_r($tmp,true));
        return $this->send($this->to_soap_array(parent::edit_sections($client,$sesskey,$tmp),
        'sections', 'sectionRecord', get_string('nothingtodo','wspp')));
    }


    function add_category($client, $sesskey, $datum) {
       $tmp= new  editCategoriesInput();
        $datum->action='add';
        $tmp->setCategories(array($datum));
        return $this->send($this->to_soap_array(parent::edit_categories($client,$sesskey,$tmp),
        'categories', 'categoryRecord', get_string('nothingtodo','wspp')));
    }


	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 START LILLE FUNCTIONS                                                     *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/

	function edit_labels($client, $sesskey, $labels) {
        return $this->send($this->to_soap_array(parent :: edit_labels($client, $sesskey, $labels),
         'labels', 'labelRecord', get_string('nothingtodo','wspp')));
	}

	function edit_groups($client, $sesskey, $groups) {
	return $this->send($this->to_soap_array(parent :: edit_groups($client, $sesskey, $groups),
         'groups', 'groupRecord', get_string('nothingtodo','wspp')));

	}

	function edit_assignments($client, $sesskey, $assignments) {
        return $this->send($this->to_soap_array(parent :: edit_assignments($client, $sesskey, $assignments),
         'assignments', 'assignmentRecord', get_string('nothingtodo','wspp')));
	}

	function edit_databases($client, $sesskey, $databases) {
        return $this->send($this->to_soap_array(parent :: edit_databases($client, $sesskey, $databases),
         'databases', 'databaseRecord', get_string('nothingtodo','wspp')));
			}

	function edit_categories($client, $sesskey, $categories) {
        return $this->send($this->to_soap_array(parent :: edit_categories($client, $sesskey, $categories),
         'categories', 'categoryRecord', get_string('nothingtodo','wspp')));

	}

	function edit_sections($client, $sesskey, $sections) {
        return $this->send($this->to_soap_array(parent :: edit_sections($client, $sesskey, $sections),
         'sections', 'sectionRecord', get_string('nothingtodo','wspp')));

	}

	function edit_forums($client, $sesskey, $forums) {
        return $this->send($this->to_soap_array(parent :: edit_forums($client, $sesskey, $forums),
         'forums', 'forumRecord', get_string('nothingtodo','wspp')));
        	}

	function edit_wikis($client, $sesskey, $wikis) {
        return $this->send($this->to_soap_array(parent :: edit_wikis($client, $sesskey, $wikis),
         'wikis', 'wikiRecord', get_string('nothingtodo','wspp')));
	}

	function edit_pagesWiki($client, $sesskey, $pagesWiki) {
        return $this->send($this->to_soap_array(parent :: edit_pagesWiki($client, $sesskey, $pagesWiki),
         'pagesWiki', 'pageWikiRecord', get_string('nothingtodo','wspp')));

	}

	function affect_course_to_category($client, $sesskey, $courseid, $categoryid) {
		return $this->send($this->to_soap(parent :: affect_course_to_category($client, $sesskey, $courseid, $categoryid),
         "affectRecord"));
	}

	function affect_label_to_section($client, $sesskey, $labelid, $sectionid) {
		return $this->send($this->to_soap(parent :: affect_label_to_section($client, $sesskey, $labelid, $sectionid),
       "affectRecord"));
	}

	function affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode) {
		return $this->send($this->to_soap(parent :: affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode),
         "affectRecord"));
	}

	function affect_section_to_course($client, $sesskey, $sectionid, $courseid) {
		return $this->send($this->to_soap(parent :: affect_section_to_course($client, $sesskey, $sectionid, $courseid),
         "affectRecord"));
	}

	function affect_user_to_group($client, $sesskey, $userid, $groupid) {
		return $this->send($this->to_soap(parent :: affect_user_to_group($client, $sesskey, $userid, $groupid), "affectRecord"));
	}

	function affect_group_to_course($client, $sesskey, $groupid, $courseid) {
		return $this->send($this->to_soap(parent :: affect_group_to_course($client, $sesskey, $groupid, $courseid),
     "affectRecord"));
	}


	function affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible) {
		return $this->send($this->to_soap(parent :: affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible),
          "affectRecord"));
	}

	function affect_database_to_section($client, $sesskey, $databaseid, $sectionid) {
		return $this->send($this->to_soap(parent :: affect_database_to_section($client, $sesskey, $databaseid, $sectionid),
          "affectRecord"));
	}

	function affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode) {
		return $this->send($this->to_soap(parent :: affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode),
        "affectRecord"));
	}

	function affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename) {
		$rest = parent :: affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename);
		return $this->send($this->to_soap($rest, 'affectRecord'));
	}

	function affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid) {
		$rest = parent :: affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid);
		return $this->send($this->to_soap($rest, 'affectRecord'));
	}

	function remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename) {
		$rest = parent :: remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename);
		return $this->send($this->to_soap($rest, 'affectRecord'));
	}

	//------------------------------------------------------------------------------------------------------------------------

	function get_all_wikis($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_wikis($client, $sesskey, $fieldname, $fieldvalue),
         'wikis', 'wikiRecord', get_string('nowikis','wspp')));
	}

	function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue),
           'pageswiki', 'pageWikiRecord', get_string('nowikipages','wspp')));
	}

	function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_groups($client, $sesskey, $fieldname, $fieldvalue),
            'groups', 'groupRecord', get_string('nogroups','wspp')));
	}

	function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_forums($client, $sesskey, $fieldname, $fieldvalue),
           'forums', 'forumRecord', get_string('noforums','wspp')));
	}

	function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_labels($client, $sesskey, $fieldname, $fieldvalue),
           'labels', 'labelRecord', get_string('nolabels','wspp')));
	}

	function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_assignments($client, $sesskey, $fieldname, $fieldvalue),
          'assignments', 'assignmentRecord', get_string('noassignments','wspp')));
	}

	function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
		return $this->send($this->to_soap_array(parent :: get_all_databases($client, $sesskey, $fieldname, $fieldvalue),
          'databases', 'databaseRecord', get_string('nodatabases','wspp')));
	}

	/*
	*****************************************************************************************************************************
	*                                                                                                                           *
	*                                                 END LILLE FUNCTIONS                                                     *
	*                                                                                                                           *
	*****************************************************************************************************************************
	*/

}
?>
