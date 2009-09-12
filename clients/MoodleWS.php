<?php
/**
 * MoodleWS class file
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

define('DEBUG',true);
if (DEBUG) ini_set('soap.wsdl_cache_enabled', '0');  // no caching by php in debug mode

/**
 * userRecord class
 */
require_once 'userRecord.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * sectionRecord class
 */
require_once 'sectionRecord.php';
/**
 * courseRecord class
 */
require_once 'courseRecord.php';
/**
 * userDatum class
 */
require_once 'userDatum.php';
/**
 * courseDatum class
 */
require_once 'courseDatum.php';
/**
 * gradeRecord class
 */
require_once 'gradeRecord.php';
/**
 * gradeStatsRecord class
 */
require_once 'gradeStatsRecord.php';
/**
 * studentRecord class
 */
require_once 'studentRecord.php';
/**
 * eventRecord class
 */
require_once 'eventRecord.php';
/**
 * changeRecord class
 */
require_once 'changeRecord.php';
/**
 * roleRecord class
 */
require_once 'roleRecord.php';
/**
 * categoryRecord class
 */
require_once 'categoryRecord.php';
/**
 * resourceRecord class
 */
require_once 'resourceRecord.php';
/**
 * studentGradeRecord class
 */
require_once 'studentGradeRecord.php';
/**
 * loginReturn class
 */
require_once 'loginReturn.php';
/**
 * editUsersInput class
 */
require_once 'editUsersInput.php';
/**
 * editUsersOutput class
 */
require_once 'editUsersOutput.php';
/**
 * getUsersReturn class
 */
require_once 'getUsersReturn.php';
/**
 * editCoursesInput class
 */
require_once 'editCoursesInput.php';
/**
 * editCoursesOutput class
 */
require_once 'editCoursesOutput.php';
/**
 * getCoursesReturn class
 */
require_once 'getCoursesReturn.php';
/**
 * getGradesReturn class
 */
require_once 'getGradesReturn.php';
/**
 * enrolStudentsReturn class
 */
require_once 'enrolStudentsReturn.php';
/**
 * getRolesReturn class
 */
require_once 'getRolesReturn.php';
/**
 * getGroupsReturn class
 */
require_once 'getGroupsReturn.php';
/**
 * getEventsReturn class
 */
require_once 'getEventsReturn.php';
/**
 * getLastChangesReturn class
 */
require_once 'getLastChangesReturn.php';
/**
 * getCategoriesReturn class
 */
require_once 'getCategoriesReturn.php';
/**
 * getResourcesReturn class
 */
require_once 'getResourcesReturn.php';
/**
 * getSectionsReturn class
 */
require_once 'getSectionsReturn.php';
/**
 * activityRecord class
 */
require_once 'activityRecord.php';
/**
 * getActivitiesReturn class
 */
require_once 'getActivitiesReturn.php';

/**
 * MoodleWS class
 * 
 *  
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */
class MoodleWS {

  public $client;

  private $uri = 'http://moodle.insa-lyon.fr/wspp/wsdl';

  public function MoodleWS($wsdl = "http://moodle.insa-lyon.fr/wspp/wsdl_pp.php", $uri=null, $options = array()) {
    if($uri != null) {
      $this->uri = $uri;
    };
    $this->client = new SoapClient($wsdl, $options);
  }

  function castTo($className,$res){ 
     if (class_exists($className)) {  
        $aux= new $className();       
        foreach ($res as $key=>$value) 
             $aux->$key=$value;        
        return $aux;                   
     } else                            
        return $res;                   
  }                                   
 
  /**
   * MoodleWS Client Login 
   *
   * @param string $username
   * @param string $password
   * @return loginReturn
   */
  public function login($username, $password) {
    $res= $this->client->__call('login', array(
            new SoapParam($username, 'username'),
            new SoapParam($password, 'password')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('loginReturn',$res);
  }

  /**
   * MoodleWS: Client Logout 
   *
   * @param integer $client
   * @param string $sesskey
   * @return boolean
   */
  public function logout($client, $sesskey) {
    $res= $this->client->__call('logout', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: Edit Users Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editUsersInput $users
   * @return editUsersOutput
   */
  public function edit_users($client, $sesskey, editUsersInput $users) {
    $res= $this->client->__call('edit_users', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($users, 'users')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editUsersOutput',$res);
  }

  /**
   * MoodleWS: Get Users Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param (getUsersInput) array of string $userids
   * @param string $idfield
   * @return getUsersReturn
   */
  public function get_users($client, $sesskey, $userids, $idfield) {
    $res= $this->client->__call('get_users', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userids, 'userids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Edit Courses Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editCoursesInput $courses
   * @return editCoursesOutput
   */
  public function edit_courses($client, $sesskey, editCoursesInput $courses) {
    $res= $this->client->__call('edit_courses', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courses, 'courses')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editCoursesOutput',$res);
  }

  /**
   * MoodleWS: Get Courses Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param (getCoursesInput) array of string $courseids
   * @param string $idfield
   * @return getCoursesReturn
   */
  public function get_courses($client, $sesskey, $courseids, $idfield) {
    $res= $this->client->__call('get_courses', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseids, 'courseids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get resources in courses 
   *
   * @param integer $client
   * @param string $sesskey
   * @param (getCoursesInput) array of string $courseids
   * @param string $idfield
   * @return getResourcesReturn
   */
  public function get_resources($client, $sesskey, $courseids, $idfield) {
    $res= $this->client->__call('get_resources', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseids, 'courseids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getResourcesReturn',$res);
  }

  /**
   * MoodleWS: Get Course sections 
   *
   * @param integer $client
   * @param string $sesskey
   * @param (getCoursesInput) array of string $courseids
   * @param string $idfield
   * @return getSectionsReturn
   */
  public function get_sections($client, $sesskey, $courseids, $idfield) {
    $res= $this->client->__call('get_sections', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseids, 'courseids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getSectionsReturn',$res);
  }

  /**
   * MoodleWS: Get resources in courses 
   *
   * @param integer $client
   * @param string $sesskey
   * @param (getCoursesInput) array of string $courseids
   * @param string $idfield
   * @param string $type
   * @return getResourcesReturn
   */
  public function get_instances_bytype($client, $sesskey, $courseids, $idfield, $type) {
    $res= $this->client->__call('get_instances_bytype', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseids, 'courseids'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($type, 'type')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getResourcesReturn',$res);
  }

  /**
   * MoodleWS: Get User Grades 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userid
   * @param (getGradesInput) array of string $courseids
   * @param string $idfield
   * @return getGradesReturn
   */
  public function get_grades($client, $sesskey, $userid, $courseids, $idfield) {
    $res= $this->client->__call('get_grades', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($courseids, 'courseids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGradesReturn',$res);
  }

  /**
   * MoodleWS: Enrol students in a course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param (enrolStudentsInput) array of string $userids
   * @param string $idfield
   * @return enrolStudentsReturn
   */
  public function enrol_students($client, $sesskey, $courseid, $userids, $idfield) {
    $res= $this->client->__call('enrol_students', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($userids, 'userids'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('enrolStudentsReturn',$res);
  }

  /**
   * MoodleWS: Get last changes to a Moodle s course 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @param integer $limit
   * @return getLastChangesReturn
   */
  public function get_last_changes($client, $sesskey, $courseid, $idfield, $limit) {
    $res= $this->client->__call('get_last_changes', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($limit, 'limit')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getLastChangesReturn',$res);
  }

  /**
   * MoodleWS: Get Moodle s events 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $eventtype
   * @param integer $ownerid
   * @return getEventsReturn
   */
  public function get_events($client, $sesskey, $eventtype, $ownerid) {
    $res= $this->client->__call('get_events', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($eventtype, 'eventtype'),
            new SoapParam($ownerid, 'ownerid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getEventsReturn',$res);
  }

  /**
   * MoodleWS: Get Course Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return getCoursesReturn
   */
  public function get_course($client, $sesskey, $courseid, $idfield) {
    $res= $this->client->__call('get_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get Course Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $info
   * @return getCoursesReturn
   */
  public function get_course_byid($client, $sesskey, $info) {
    $res= $this->client->__call('get_course_byid', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($info, 'info')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get Course Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $info
   * @return getCoursesReturn
   */
  public function get_course_byidnumber($client, $sesskey, $info) {
    $res= $this->client->__call('get_course_byidnumber', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($info, 'info')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get one User Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userid
   * @param string $idfield
   * @return getUsersReturn
   */
  public function get_user($client, $sesskey, $userid, $idfield) {
    $res= $this->client->__call('get_user', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Get All roles defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @return getRolesReturn
   */
  public function get_roles($client, $sesskey) {
    $res= $this->client->__call('get_roles', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getRolesReturn',$res);
  }

  /**
   * MoodleWS: Get one role defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return getRolesReturn
   */
  public function get_role_byid($client, $sesskey, $value) {
    $res= $this->client->__call('get_role_byid', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getRolesReturn',$res);
  }

  /**
   * MoodleWS: Get one role defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return getRolesReturn
   */
  public function get_role_byname($client, $sesskey, $value) {
    $res= $this->client->__call('get_role_byname', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getRolesReturn',$res);
  }

  /**
   * MoodleWS: Get  Moodle  course categories 
   *
   * @param integer $client
   * @param string $sesskey
   * @return getCategoriesReturn
   */
  public function get_categories($client, $sesskey) {
    $res= $this->client->__call('get_categories', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCategoriesReturn',$res);
  }

  /**
   * MoodleWS: Get one category defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return getCategoriesReturn
   */
  public function get_category_byid($client, $sesskey, $value) {
    $res= $this->client->__call('get_category_byid', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCategoriesReturn',$res);
  }

  /**
   * MoodleWS: Get one category defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @return getCategoriesReturn
   */
  public function get_category_byname($client, $sesskey, $value) {
    $res= $this->client->__call('get_category_byname', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCategoriesReturn',$res);
  }

  /**
   * MoodleWS: Get Courses user identified by id is 
   * member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $uid
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses($client, $sesskey, $uid, $sort) {
    $res= $this->client->__call('get_my_courses', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($uid, 'uid'),
            new SoapParam($sort, 'sort')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get Courses current user identified 
   * by username is  member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $uinfo
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses_byusername($client, $sesskey, $uinfo, $sort) {
    $res= $this->client->__call('get_my_courses_byusername', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($uinfo, 'uinfo'),
            new SoapParam($sort, 'sort')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get Courses current user identified 
   * by idnumber is  member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $uinfo
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses_byidnumber($client, $sesskey, $uinfo, $sort) {
    $res= $this->client->__call('get_my_courses_byidnumber', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($uinfo, 'uinfo'),
            new SoapParam($sort, 'sort')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get user info from Moodle user login 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userinfo
   * @return getUsersReturn
   */
  public function get_user_byusername($client, $sesskey, $userinfo) {
    $res= $this->client->__call('get_user_byusername', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userinfo, 'userinfo')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Get user info from Moodle user id number 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userinfo
   * @return getUsersReturn
   */
  public function get_user_byidnumber($client, $sesskey, $userinfo) {
    $res= $this->client->__call('get_user_byidnumber', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userinfo, 'userinfo')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Get user info from Moodle user id 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userinfo
   * @return getUsersReturn
   */
  public function get_user_byid($client, $sesskey, $userinfo) {
    $res= $this->client->__call('get_user_byid', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userinfo, 'userinfo')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Get users having a role in a course 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $idcourse
   * @param string $idfield
   * @param integer $idrole
   * @return getUsersReturn
   */
  public function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole) {
    $res= $this->client->__call('get_users_bycourse', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($idcourse, 'idcourse'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idrole, 'idrole')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: count users having a role in a course 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $idcourse
   * @param string $idfield
   * @param integer $idrole
   * @return integer
   */
  public function count_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole) {
    $res= $this->client->__call('count_users_bycourse', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($idcourse, 'idcourse'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($idrole, 'idrole')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: Get Courses belonging to category 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $categoryid
   * @return getCoursesReturn
   */
  public function get_courses_bycategory($client, $sesskey, $categoryid) {
    $res= $this->client->__call('get_courses_bycategory', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($categoryid, 'categoryid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getCoursesReturn',$res);
  }

  /**
   * MoodleWS: Get Course groups 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return getGroupsReturn
   */
  public function get_groups_bycourse($client, $sesskey, $courseid, $idfield) {
    $res= $this->client->__call('get_groups_bycourse', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($idfield, 'idfield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get Course Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $info
   * @param integer $courseid
   * @return getGroupsReturn
   */
  public function get_group_byid($client, $sesskey, $info, $courseid) {
    $res= $this->client->__call('get_group_byid', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($info, 'info'),
            new SoapParam($courseid, 'courseid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get Course Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $info
   * @param integer $courseid
   * @return getGroupsReturn
   */
  public function get_groups_byname($client, $sesskey, $info, $courseid) {
    $res= $this->client->__call('get_groups_byname', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($info, 'info'),
            new SoapParam($courseid, 'courseid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get users members of a group in course 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $groupid
   * @return getUsersReturn
   */
  public function get_group_members($client, $sesskey, $groupid) {
    $res= $this->client->__call('get_group_members', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($groupid, 'groupid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: get current user Moodle internal id 
   * (helper) 
   *
   * @param integer $client
   * @param string $sesskey
   * @return integer
   */
  public function get_my_id($client, $sesskey) {
    $res= $this->client->__call('get_my_id', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: Get user group in course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $courseid
   * @param integer $uid
   * @return getGroupsReturn
   */
  public function get_my_group($client, $sesskey, $courseid, $uid) {
    $res= $this->client->__call('get_my_group', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($uid, 'uid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get user groups in all Moodle site 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $uid
   * @return getGroupsReturn
   */
  public function get_my_groups($client, $sesskey, $uid) {
    $res= $this->client->__call('get_my_groups', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($uid, 'uid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get course teachers 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @param string $id
   * @return getUsersReturn
   */
  public function get_teachers($client, $sesskey, $value, $id) {
    $res= $this->client->__call('get_teachers', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value'),
            new SoapParam($id, 'id')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: Get course students 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value
   * @param string $id
   * @return getUsersReturn
   */
  public function get_students($client, $sesskey, $value, $id) {
    $res= $this->client->__call('get_students', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value, 'value'),
            new SoapParam($id, 'id')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getUsersReturn',$res);
  }

  /**
   * MoodleWS: check if user has a given role in a 
   * given course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $iduser
   * @param string $iduserfield
   * @param string $idcourse
   * @param string $idcoursefield
   * @param integer $idrole
   * @return boolean
   */
  public function has_role_incourse($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield, $idrole) {
    $res= $this->client->__call('has_role_incourse', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($iduser, 'iduser'),
            new SoapParam($iduserfield, 'iduserfield'),
            new SoapParam($idcourse, 'idcourse'),
            new SoapParam($idcoursefield, 'idcoursefield'),
            new SoapParam($idrole, 'idrole')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: returns  user s primary role in a given 
   * course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $iduser
   * @param string $iduserfield
   * @param string $idcourse
   * @param string $idcoursefield
   * @return integer
   */
  public function get_primaryrole_incourse($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield) {
    $res= $this->client->__call('get_primaryrole_incourse', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($iduser, 'iduser'),
            new SoapParam($iduserfield, 'iduserfield'),
            new SoapParam($idcourse, 'idcourse'),
            new SoapParam($idcoursefield, 'idcoursefield')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: Get user most recent activities in a 
   * Moodle course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $iduser
   * @param string $iduserfield
   * @param string $idcourse
   * @param string $idcoursefield
   * @param integer $idlimit
   * @return getActivitiesReturn
   */
  public function get_activities($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield, $idlimit) {
    $res= $this->client->__call('get_activities', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($iduser, 'iduser'),
            new SoapParam($iduserfield, 'iduserfield'),
            new SoapParam($idcourse, 'idcourse'),
            new SoapParam($idcoursefield, 'idcoursefield'),
            new SoapParam($idlimit, 'idlimit')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getActivitiesReturn',$res);
  }

  /**
   * MoodleWS: count user most recent activities in 
   * a Moodle course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $value1
   * @param string $id1
   * @param string $value2
   * @param string $id2
   * @return integer
   */
  public function count_activities($client, $sesskey, $value1, $id1, $value2, $id2) {
    $res= $this->client->__call('count_activities', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($value1, 'value1'),
            new SoapParam($id1, 'id1'),
            new SoapParam($value2, 'value2'),
            new SoapParam($id2, 'id2')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

}

?>
