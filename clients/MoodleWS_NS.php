<?php
/**
 * MoodleWS class file
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

/**
 * userRecord class
 */
require_once 'userRecord.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
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
 * activityRecord class
 */
require_once 'activityRecord.php';
/**
 * getActivitiesReturn class
 */
require_once 'getActivitiesReturn.php';

require_once 'lib/nusoap.php';

/**
 * MoodleWS_NS class
 * 
 *  
 * 
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */
class MoodleWS_NS {

  public $client;

  public $proxy;

  private $uri = 'http://cipcnet.insa-lyon.fr/moodle/wspp/wsdl';

  public function MoodleWS_NS($wsdl = "http://localhost/moodle/wspp/wsdl_pp.php", $uri=null, $options = array()) {
    if($uri != null) {
      $this->uri = $uri;
    };
     $this->client = new soap_client($wsdl, true);
     $this->proxy=$this->client->getProxy();
  }

  /**
   * MoodleWS Client Login 
   *
   * @param string $username
   * @param string $password
   * @return loginReturn
   */
  public function login($username, $password) {
    return $this->proxy->login($username, $password);
  }

  /**
   * MoodleWS: Client Logout 
   *
   * @param integer $client
   * @param string $sesskey
   * @return boolean
   */
  public function logout($client, $sesskey) {
    return $this->proxy->logout($client, $sesskey);
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
    return $this->proxy->edit_users($client, $sesskey, $users);
  }

  /**
   * MoodleWS: Get Users Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param getUsersInput $userids
   * @param string $idfield
   * @return getUsersReturn
   */
  public function get_users($client, $sesskey, $userids, $idfield) {
    return $this->proxy->get_users($client, $sesskey, $userids, $idfield);
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
    return $this->proxy->edit_courses($client, $sesskey, $courses);
  }

  /**
   * MoodleWS: Get Courses Information 
   *
   * @param integer $client
   * @param string $sesskey
   * @param getCoursesInput $courseids
   * @param string $idfield
   * @return getCoursesReturn
   */
  public function get_courses($client, $sesskey, $courseids, $idfield) {
    return $this->proxy->get_courses($client, $sesskey, $courseids, $idfield);
  }

  /**
   * MoodleWS: Get User Grades 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userid
   * @param getGradesInput $courseids
   * @param string $idfield
   * @return getGradesReturn
   */
  public function get_grades($client, $sesskey, $userid, $courseids, $idfield) {
    return $this->proxy->get_grades($client, $sesskey, $userid, $courseids, $idfield);
  }

  /**
   * MoodleWS: Enrol students in a course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param enrolStudentsInput $userids
   * @param string $idfield
   * @return enrolStudentsReturn
   */
  public function enrol_students($client, $sesskey, $courseid, $userids, $idfield) {
    return $this->proxy->enrol_students($client, $sesskey, $courseid, $userids, $idfield);
  }

  /**
   * MoodleWS: Get last changes to a Moodle s course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @param integer $limit
   * @return getLastChangesReturn
   */
  public function get_last_changes($client, $sesskey, $courseid, $idfield, $limit) {
    return $this->proxy->get_last_changes($client, $sesskey, $courseid, $idfield, $limit);
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
    return $this->proxy->get_events($client, $sesskey, $eventtype, $ownerid);
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
    return $this->proxy->get_course($client, $sesskey, $courseid, $idfield);
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
    return $this->proxy->get_course_byid($client, $sesskey, $info);
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
    return $this->proxy->get_course_byidnumber($client, $sesskey, $info);
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
    return $this->proxy->get_user($client, $sesskey, $userid, $idfield);
  }

  /**
   * MoodleWS: Get All roles defined in Moodle 
   *
   * @param integer $client
   * @param string $sesskey
   * @return getRolesReturn
   */
  public function get_roles($client, $sesskey) {
    return $this->proxy->get_roles($client, $sesskey);
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
    return $this->proxy->get_role_byid($client, $sesskey, $value);
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
    return $this->proxy->get_role_byname($client, $sesskey, $value);
  }

  /**
   * MoodleWS: Get  Moodle  course categories 
   *
   * @param integer $client
   * @param string $sesskey
   * @return getCategoriesReturn
   */
  public function get_categories($client, $sesskey) {
    return $this->proxy->get_categories($client, $sesskey);
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
    return $this->proxy->get_category_byid($client, $sesskey, $value);
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
    return $this->proxy->get_category_byname($client, $sesskey, $value);
  }

  /**
   * MoodleWS: Get Courses user identified by id is member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $uid
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses($client, $sesskey, $uid, $sort) {
    return $this->proxy->get_my_courses($client, $sesskey, $uid, $sort);
  }

  /**
   * MoodleWS: Get Courses current user identified by username is  member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $uinfo
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses_byusername($client, $sesskey, $uinfo, $sort) {
    return $this->proxy->get_my_courses_byusername($client, $sesskey, $uinfo, $sort);
  }

  /**
   * MoodleWS: Get Courses current user identified by idnumber is  member of 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $uinfo
   * @param string $sort
   * @return getCoursesReturn
   */
  public function get_my_courses_byidnumber($client, $sesskey, $uinfo, $sort) {
    return $this->proxy->get_my_courses_byidnumber($client, $sesskey, $uinfo, $sort);
  }

  /**
   * MoodleWS: Get user info from Moodle user login 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userinfo
   * @return getUsersReturn
   */
  public function get_user_byusername($client, $sesskey, $userinfo) {
    return $this->proxy->get_user_byusername($client, $sesskey, $userinfo);
  }

  /**
   * MoodleWS: Get user info from Moodle user id number 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $userinfo
   * @return getUsersReturn
   */
  public function get_user_byidnumber($client, $sesskey, $userinfo) {
    return $this->proxy->get_user_byidnumber($client, $sesskey, $userinfo);
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
    return $this->proxy->get_user_byid($client, $sesskey, $userinfo);
  }

  /**
   * MoodleWS: Get users having a role in a course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $idcourse
   * @param string $idfield
   * @param integer $idrole
   * @return getUsersReturn
   */
  public function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole) {
    return $this->proxy->get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole);
  }

  /**
   * MoodleWS: count users having a role in a course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param string $idcourse
   * @param string $idfield
   * @param integer $idrole
   * @return integer
   */
  public function count_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole) {
    return $this->proxy->count_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole);
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
    return $this->proxy->get_courses_bycategory($client, $sesskey, $categoryid);
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
    return $this->proxy->get_groups_bycourse($client, $sesskey, $courseid, $idfield);
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
    return $this->proxy->get_group_byid($client, $sesskey, $info, $courseid);
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
    return $this->proxy->get_groups_byname($client, $sesskey, $info, $courseid);
  }

  /**
   * MoodleWS: Get users members of a group in course 
   *
   * @param integer $client
   * @param string $sesskey
   * @param integer $groupid
   * @return getUsersReturn
   */
  public function get_group_members($client, $sesskey, $groupid) {
    return $this->proxy->get_group_members($client, $sesskey, $groupid);
  }

  /**
   * MoodleWS: get current user Moodle internal id (helper) 
   *
   * @param integer $client
   * @param string $sesskey
   * @return integer
   */
  public function get_my_id($client, $sesskey) {
    return $this->proxy->get_my_id($client, $sesskey);
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
    return $this->proxy->get_my_group($client, $sesskey, $courseid, $uid);
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
    return $this->proxy->get_my_groups($client, $sesskey, $uid);
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
    return $this->proxy->get_teachers($client, $sesskey, $value, $id);
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
    return $this->proxy->get_students($client, $sesskey, $value, $id);
  }

  /**
   * MoodleWS: check if user has a given role in a given course 
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
    return $this->proxy->has_role_incourse($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield, $idrole);
  }

  /**
   * MoodleWS: returns  user s primary role in a given course 
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
    return $this->proxy->get_primaryrole_incourse($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield);
  }

  /**
   * MoodleWS: Get user most recent activities in a Moodle course 
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
    return $this->proxy->get_activities($client, $sesskey, $iduser, $iduserfield, $idcourse, $idcoursefield, $idlimit);
  }

  /**
   * MoodleWS: count user most recent activities in a Moodle course 
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
    return $this->proxy->count_activities($client, $sesskey, $value1, $id1, $value2, $id2);
  }

}

?>
