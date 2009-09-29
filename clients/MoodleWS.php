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
 * affectRecord class
 */
require_once 'affectRecord.php';
/**
 * editLabelsInput class
 */
require_once 'editLabelsInput.php';
/**
 * labelDatum class
 */
require_once 'labelDatum.php';
/**
 * editLabelsOutput class
 */
require_once 'editLabelsOutput.php';
/**
 * labelRecord class
 */
require_once 'labelRecord.php';
/**
 * editGroupsInput class
 */
require_once 'editGroupsInput.php';
/**
 * groupDatum class
 */
require_once 'groupDatum.php';
/**
 * editGroupsOutput class
 */
require_once 'editGroupsOutput.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * editCategoriesInput class
 */
require_once 'editCategoriesInput.php';
/**
 * categoryDatum class
 */
require_once 'categoryDatum.php';
/**
 * editCategoriesOutput class
 */
require_once 'editCategoriesOutput.php';
/**
 * editSectionsInput class
 */
require_once 'editSectionsInput.php';
/**
 * sectionDatum class
 */
require_once 'sectionDatum.php';
/**
 * editSectionsOutput class
 */
require_once 'editSectionsOutput.php';
/**
 * editForumsInput class
 */
require_once 'editForumsInput.php';
/**
 * forumDatum class
 */
require_once 'forumDatum.php';
/**
 * editForumsOutput class
 */
require_once 'editForumsOutput.php';
/**
 * forumRecord class
 */
require_once 'forumRecord.php';
/**
 * editAssignmentsInput class
 */
require_once 'editAssignmentsInput.php';
/**
 * assignmentDatum class
 */
require_once 'assignmentDatum.php';
/**
 * editAssignmentsOutput class
 */
require_once 'editAssignmentsOutput.php';
/**
 * assignmentRecord class
 */
require_once 'assignmentRecord.php';
/**
 * editDatabasesInput class
 */
require_once 'editDatabasesInput.php';
/**
 * databaseDatum class
 */
require_once 'databaseDatum.php';
/**
 * editDatabasesOutput class
 */
require_once 'editDatabasesOutput.php';
/**
 * databaseRecord class
 */
require_once 'databaseRecord.php';
/**
 * editWikisInput class
 */
require_once 'editWikisInput.php';
/**
 * wikiDatum class
 */
require_once 'wikiDatum.php';
/**
 * editWikisOutput class
 */
require_once 'editWikisOutput.php';
/**
 * wikiRecord class
 */
require_once 'wikiRecord.php';
/**
 * editPagesWikiInput class
 */
require_once 'editPagesWikiInput.php';
/**
 * pageWikiDatum class
 */
require_once 'pageWikiDatum.php';
/**
 * editPagesWikiOutput class
 */
require_once 'editPagesWikiOutput.php';
/**
 * pageWikiRecord class
 */
require_once 'pageWikiRecord.php';
/**
 * getAllForumsReturn class
 */
require_once 'getAllForumsReturn.php';
/**
 * getAllLabelsReturn class
 */
require_once 'getAllLabelsReturn.php';
/**
 * getAllWikisReturn class
 */
require_once 'getAllWikisReturn.php';
/**
 * getAllPagesWikiReturn class
 */
require_once 'getAllPagesWikiReturn.php';
/**
 * getAllAssignmentsReturn class
 */
require_once 'getAllAssignmentsReturn.php';
/**
 * getAllDatabasesReturn class
 */
require_once 'getAllDatabasesReturn.php';
/**
 * userCourseID class
 */
require_once 'userCourseID.php';
/**
 * userGrade class
 */
require_once 'userGrade.php';

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

  private $uri = 'http://prope.insa-lyon.fr/moodle.195/wspp/wsdl';

  public function MoodleWS($wsdl = "http://prope.insa-lyon.fr/moodle.195/wspp/wsdl_pp.php", $uri=null, $options = array()) {
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
   * @return float
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
   return $res;
  }

  /**
   * MoodleWS: Get User Grade 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userid
   * @param string $courseid
   * @return float
   */
  public function get_grade($client, $sesskey, $userid, $courseid) {
    $res= $this->client->__call('get_grade', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($courseid, 'courseid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: Get User Grades 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userid
   * @param (userCourseIDs) array of userCourseID $courseids
   * @return userGradesReturn
   */
  public function get_user_grades($client, $sesskey, $userid, $courseids) {
    $res= $this->client->__call('get_user_grades', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($courseids, 'courseids')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
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
   * MoodleWS: Assign instructors to a course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param (enrolStudentsInput) array of string $userids
   * @param string $idfield
   * @param integer $lmsrole
   * @param boolean $enrol
   * @return enrolStudentsReturn
   */
  public function assign_instructors($client, $sesskey, $courseid, $userids, $idfield, $lmsrole, $enrol) {
    $res= $this->client->__call('assign_instructors', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($userids, 'userids'),
            new SoapParam($idfield, 'idfield'),
            new SoapParam($lmsrole, 'lmsrole'),
            new SoapParam($enrol, 'enrol')
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
   * MoodleWS: assign-unassign user as a member of 
   * a group in course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $userid
   * @param integer $atigroup
   * @param boolean $assign
   * @return boolean
   */
  public function set_group_member($client, $sesskey, $courseid, $userid, $atigroup, $assign) {
    $res= $this->client->__call('set_group_member', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($userid, 'userid'),
            new SoapParam($atigroup, 'atigroup'),
            new SoapParam($assign, 'assign')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
  }

  /**
   * MoodleWS: performs a moodle reset of a course 
   * 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $newstartdate
   * @param boolean $allincat
   * @param boolean $stuonly
   * @return boolean
   */
  public function reset_course($client, $sesskey, $courseid, $newstartdate, $allincat, $stuonly) {
    $res= $this->client->__call('reset_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($newstartdate, 'newstartdate'),
            new SoapParam($allincat, 'allincat'),
            new SoapParam($stuonly, 'stuonly')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
   return $res;
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
   * @param integer $uid
   * @param integer $courseid
   * @return getGroupsReturn
   */
  public function get_my_group($client, $sesskey, $uid, $courseid) {
    $res= $this->client->__call('get_my_group', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($uid, 'uid'),
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

  /**
   * MoodleWS: Edit Label Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editLabelsInput $labels
   * @return editLabelsOutput
   */
  public function edit_labels($client, $sesskey, editLabelsInput $labels) {
    $res= $this->client->__call('edit_labels', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($labels, 'labels')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editLabelsOutput',$res);
  }

  /**
   * MoodleWS: Edit Groups Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editGroupsInput $groups
   * @return editGroupsOutput
   */
  public function edit_groups($client, $sesskey, editGroupsInput $groups) {
    $res= $this->client->__call('edit_groups', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($groups, 'groups')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editGroupsOutput',$res);
  }

  /**
   * MoodleWS: Edit Assignment Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editAssignmentsInput $assignments
   * @return editAssignmentsOutput
   */
  public function edit_assignments($client, $sesskey, editAssignmentsInput $assignments) {
    $res= $this->client->__call('edit_assignments', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($assignments, 'assignments')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editAssignmentsOutput',$res);
  }

  /**
   * MoodleWS: Edit databases Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editDatabasesInput $databases
   * @return editDatabasesOutput
   */
  public function edit_databases($client, $sesskey, editDatabasesInput $databases) {
    $res= $this->client->__call('edit_databases', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($databases, 'databases')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editDatabasesOutput',$res);
  }

  /**
   * MoodleWS: Edit Categories Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editCategoriesInput $categories
   * @return editCategoriesOutput
   */
  public function edit_categories($client, $sesskey, editCategoriesInput $categories) {
    $res= $this->client->__call('edit_categories', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($categories, 'categories')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editCategoriesOutput',$res);
  }

  /**
   * MoodleWS: Edit section Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editSectionsInput $sections
   * @return editSectionsOutput
   */
  public function edit_sections($client, $sesskey, editSectionsInput $sections) {
    $res= $this->client->__call('edit_sections', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($sections, 'sections')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editSectionsOutput',$res);
  }

  /**
   * MoodleWS: Edit Forum Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editForumsInput $forums
   * @return editForumsOutput
   */
  public function edit_forums($client, $sesskey, editForumsInput $forums) {
    $res= $this->client->__call('edit_forums', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($forums, 'forums')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editForumsOutput',$res);
  }

  /**
   * MoodleWS: Edit Wikis Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editWikisInput $wikis
   * @return editWikisOutput
   */
  public function edit_wikis($client, $sesskey, editWikisInput $wikis) {
    $res= $this->client->__call('edit_wikis', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($wikis, 'wikis')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editWikisOutput',$res);
  }

  /**
   * MoodleWS: Edit Page of Wiki Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param editPagesWikiInput $pagesWiki
   * @return editPagesWikiOutput
   */
  public function edit_pagesWiki($client, $sesskey, editPagesWikiInput $pagesWiki) {
    $res= $this->client->__call('edit_pagesWiki', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($pagesWiki, 'pagesWiki')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('editPagesWikiOutput',$res);
  }

  /**
   * MoodleWS: Affect Course To Category 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $courseid
   * @param integer $categoryid
   * @return affectRecord
   */
  public function affect_course_to_category($client, $sesskey, $courseid, $categoryid) {
    $res= $this->client->__call('affect_course_to_category', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($categoryid, 'categoryid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect Label to Section 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $labelid
   * @param integer $sectionid
   * @return affectRecord
   */
  public function affect_label_to_section($client, $sesskey, $labelid, $sectionid) {
    $res= $this->client->__call('affect_label_to_section', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($labelid, 'labelid'),
            new SoapParam($sectionid, 'sectionid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect Forum to Section 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $forumid
   * @param integer $sectionid
   * @param integer $groupmode
   * @return affectRecord
   */
  public function affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode) {
    $res= $this->client->__call('affect_forum_to_section', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($forumid, 'forumid'),
            new SoapParam($sectionid, 'sectionid'),
            new SoapParam($groupmode, 'groupmode')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect Section To Course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $sectionid
   * @param integer $courseid
   * @return affectRecord
   */
  public function affect_section_to_course($client, $sesskey, $sectionid, $courseid) {
    $res= $this->client->__call('affect_section_to_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($sectionid, 'sectionid'),
            new SoapParam($courseid, 'courseid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a user to group 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $userid
   * @param integer $groupid
   * @return affectRecord
   */
  public function affect_user_to_group($client, $sesskey, $userid, $groupid) {
    $res= $this->client->__call('affect_user_to_group', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($groupid, 'groupid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a group to course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $groupid
   * @param integer $coursid
   * @return affectRecord
   */
  public function affect_group_to_course($client, $sesskey, $groupid, $coursid) {
    $res= $this->client->__call('affect_group_to_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($groupid, 'groupid'),
            new SoapParam($coursid, 'coursid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a wiki to section 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $wikiid
   * @param integer $sectionid
   * @param integer $groupmode
   * @param integer $visible
   * @return affectRecord
   */
  public function affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible) {
    $res= $this->client->__call('affect_wiki_to_section', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($wikiid, 'wikiid'),
            new SoapParam($sectionid, 'sectionid'),
            new SoapParam($groupmode, 'groupmode'),
            new SoapParam($visible, 'visible')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a database to section 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $databaseid
   * @param integer $sectionid
   * @return affectRecord
   */
  public function affect_database_to_section($client, $sesskey, $databaseid, $sectionid) {
    $res= $this->client->__call('affect_database_to_section', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($databaseid, 'databaseid'),
            new SoapParam($sectionid, 'sectionid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a section to assignment 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $assignmentid
   * @param integer $sectionid
   * @param integer $groupmode
   * @return affectRecord
   */
  public function affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode) {
    $res= $this->client->__call('affect_assignment_to_section', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($assignmentid, 'assignmentid'),
            new SoapParam($sectionid, 'sectionid'),
            new SoapParam($groupmode, 'groupmode')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect user to the course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $userid
   * @param integer $courseid
   * @param string $rolename
   * @return affectRecord
   */
  public function affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename) {
    $res= $this->client->__call('affect_user_to_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($rolename, 'rolename')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Affect a page of wiki to a wiki 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $pageid
   * @param integer $wikiid
   * @return affectRecord
   */
  public function affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid) {
    $res= $this->client->__call('affect_pageWiki_to_wiki', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($pageid, 'pageid'),
            new SoapParam($wikiid, 'wikiid')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Remove the role specified of the user 
   * in the course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $userid
   * @param integer $courseid
   * @param string $rolename
   * @return affectRecord
   */
  public function remove_userRole_from_course($client, $sesskey, $userid, $courseid, $rolename) {
    $res= $this->client->__call('remove_userRole_from_course', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($userid, 'userid'),
            new SoapParam($courseid, 'courseid'),
            new SoapParam($rolename, 'rolename')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('affectRecord',$res);
  }

  /**
   * MoodleWS: Get All Groups 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getGroupsReturn
   */
  public function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_groups', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getGroupsReturn',$res);
  }

  /**
   * MoodleWS: Get All Forums 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllForumsReturn
   */
  public function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_forums', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllForumsReturn',$res);
  }

  /**
   * MoodleWS: Get All Labels 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllLabelsReturn
   */
  public function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_labels', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllLabelsReturn',$res);
  }

  /**
   * MoodleWS: Get All wikis 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllWikisReturn
   */
  public function get_all_wikis($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_wikis', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllWikisReturn',$res);
  }

  /**
   * MoodleWS: Get All Pages Wikis 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllPagesWikiReturn
   */
  public function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_pagesWiki', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllPagesWikiReturn',$res);
  }

  /**
   * MoodleWS: Get All Assignments 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllAssignmentsReturn
   */
  public function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_assignments', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllAssignmentsReturn',$res);
  }

  /**
   * MoodleWS: Get All Databases 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return getAllDatabasesReturn
   */
  public function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->client->__call('get_all_databases', array(
            new SoapParam($client, 'client'),
            new SoapParam($sesskey, 'sesskey'),
            new SoapParam($fieldname, 'fieldname'),
            new SoapParam($fieldvalue, 'fieldvalue')
      ),
      array(
            'uri' => $this->uri ,
            'soapaction' => ''
           )
      );
  return $this->castTo ('getAllDatabasesReturn',$res);
  }

}

?>
