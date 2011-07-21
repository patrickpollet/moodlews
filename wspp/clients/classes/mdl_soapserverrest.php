<?php
/**
 * mdl_soapserverrest class file
 *
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */

define('DEBUG',true);
/**
 * assignmentDatum class
 */
require_once 'assignmentDatum.php';
/**
 * assignmentRecord class
 */
require_once 'assignmentRecord.php';
/**
 * categoryDatum class
 */
require_once 'categoryDatum.php';
/**
 * categoryRecord class
 */
require_once 'categoryRecord.php';
/**
 * cohortDatum class
 */
require_once 'cohortDatum.php';
/**
 * cohortRecord class
 */
require_once 'cohortRecord.php';
/**
 * courseDatum class
 */
require_once 'courseDatum.php';
/**
 * courseRecord class
 */
require_once 'courseRecord.php';
/**
 * databaseDatum class
 */
require_once 'databaseDatum.php';
/**
 * databaseRecord class
 */
require_once 'databaseRecord.php';
/**
 * forumDatum class
 */
require_once 'forumDatum.php';
/**
 * forumRecord class
 */
require_once 'forumRecord.php';
/**
 * groupDatum class
 */
require_once 'groupDatum.php';
/**
 * groupRecord class
 */
require_once 'groupRecord.php';
/**
 * groupingDatum class
 */
require_once 'groupingDatum.php';
/**
 * groupingRecord class
 */
require_once 'groupingRecord.php';
/**
 * labelDatum class
 */
require_once 'labelDatum.php';
/**
 * labelRecord class
 */
require_once 'labelRecord.php';
/**
 * affectRecord class
 */
require_once 'affectRecord.php';
/**
 * pageWikiDatum class
 */
require_once 'pageWikiDatum.php';
/**
 * pageWikiRecord class
 */
require_once 'pageWikiRecord.php';
/**
 * sectionDatum class
 */
require_once 'sectionDatum.php';
/**
 * sectionRecord class
 */
require_once 'sectionRecord.php';
/**
 * userDatum class
 */
require_once 'userDatum.php';
/**
 * userRecord class
 */
require_once 'userRecord.php';
/**
 * profileitemRecord class
 */
require_once 'profileitemRecord.php';
/**
 * wikiDatum class
 */
require_once 'wikiDatum.php';
/**
 * wikiRecord class
 */
require_once 'wikiRecord.php';
/**
 * enrolRecord class
 */
require_once 'enrolRecord.php';
/**
 * forumDiscussionDatum class
 */
require_once 'forumDiscussionDatum.php';
/**
 * forumDiscussionRecord class
 */
require_once 'forumDiscussionRecord.php';
/**
 * forumPostRecord class
 */
require_once 'forumPostRecord.php';
/**
 * forumPostDatum class
 */
require_once 'forumPostDatum.php';
/**
 * activityRecord class
 */
require_once 'activityRecord.php';
/**
 * quizRecord class
 */
require_once 'quizRecord.php';
/**
 * assignmentSubmissionRecord class
 */
require_once 'assignmentSubmissionRecord.php';
/**
 * fileRecord class
 */
require_once 'fileRecord.php';
/**
 * gradeRecord class
 */
require_once 'gradeRecord.php';
/**
 * eventRecord class
 */
require_once 'eventRecord.php';
/**
 * resourceRecord class
 */
require_once 'resourceRecord.php';
/**
 * changeRecord class
 */
require_once 'changeRecord.php';
/**
 * contactRecord class
 */
require_once 'contactRecord.php';
/**
 * messageRecord class
 */
require_once 'messageRecord.php';
/**
 * gradeItemRecord class
 */
require_once 'gradeItemRecord.php';
/**
 * roleRecord class
 */
require_once 'roleRecord.php';
/**
 * loginReturn class
 */
require_once 'loginReturn.php';

/**
 * mdl_soapserverrest class
		* the two attributes are made public for debugging purpose
		* i.e. accessing $client->client->__getLast* methods
 *
 *
 *
 * @author    Patrick Pollet :<patrick.pollet@insa-lyon.fr>
 * @copyright (c) P.Pollet 2007 under GPL
 * @package   MoodleWS
 */
class mdl_soapserverrest {

	    private $serviceurl='';
		private $formatout='php';
	    private $verbose=false;
	    private $postdata='';
	    public $requestResponse='';


		/**
		 * Constructor method
		 * @param string $wsdl URL of the WSDL
		 * @param string $uri
		 * @param string[] $options  Soap Client options array (see PHP5 documentation)
		 * @return mdl_soapserverrest
		 */
  public function mdl_soapserverrest($serviceurl = "http://cipcnet.insa-lyon.fr/moodle.195/wspp/service_pp2.php", $options = array()) {
     $this->serviceurl=$serviceurl;
      $this->verbose=! empty($options['trace']);
 		if (!empty($options['formatout']))
     			$this->setFormatout($options['formatout']);
  }


      private function castTo($className,$res){
        	if ($this->formatout==='php') return $res;  //already done
            if (class_exists($className)) {
                $aux= new $className();
                foreach ($res as $key=>$value)
                    $aux->$key=$value;
                return $aux;
             } else
                return $res;
        }



	/**
	 * @param string
	 */
	function __call ($methodname, $params) {
		$params['wsformatout']=$this->formatout;
		$params['wsfunction']=$methodname;
        // forcing the separator to '&' is capital with some php version that use otherwise &amp;
        // in 'apache mode' but not in 'cli mode' and break parameter parsing on the server side ...
		$this->postdata = http_build_query($params,'','&');

		//print_r($this);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->serviceurl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POST, true);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postdata);
		if ($this->verbose)
			curl_setopt($ch, CURLOPT_VERBOSE, true);
		$this->requestResponse = curl_exec($ch);
		//print_r("retour curl".$this->requestResponse);
		curl_close($ch);
		if ($methodname==='login') return $this->deserialize($this->requestResponse,'php');
		else return $this->deserialize($this->requestResponse);

	}



	function deserialize ($data,$formatout='') {
		$formatout=$formatout?$formatout:$this->formatout;
		switch ($formatout) {
			case 'xml':break;
			case 'json':break;
			case 'php':$data=unserialize($data); break;
			case 'dump':break;
		}
		return $data;
	}

	function getFormatout() {
		return $this->formatout;
	}

	function setFormatout($formatout='php') {
		if (empty($formatout)) $formatout='php';
		$this->formatout=$formatout;
	}

	function getPostdata() {
		return $this->postdata;
	}

	function getRequestResponse() {
		return $this->requestResponse;
	}


  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param assignmentDatum $datum
   * @return assignmentRecord[]
   */
  public function add_assignment($client, $sesskey, assignmentDatum $datum) {
    $res= $this->__call('add_assignment', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param categoryDatum $datum
   * @return categoryRecord[]
   */
  public function add_category($client, $sesskey, categoryDatum $datum) {
    $res= $this->__call('add_category', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param cohortDatum $datum
   * @return cohortRecord[]
   */
  public function add_cohort($client, $sesskey, cohortDatum $datum) {
    $res= $this->__call('add_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param courseDatum $coursedatum
   * @return courseRecord[]
   */
  public function add_course($client, $sesskey, courseDatum $coursedatum) {
    $res= $this->__call('add_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'coursedatum'=>$coursedatum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param databaseDatum $datum
   * @return databaseRecord[]
   */
  public function add_database($client, $sesskey, databaseDatum $datum) {
    $res= $this->__call('add_database', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param forumDatum $datum
   * @return forumRecord[]
   */
  public function add_forum($client, $sesskey, forumDatum $datum) {
    $res= $this->__call('add_forum', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupDatum $datum
   * @return groupRecord[]
   */
  public function add_group($client, $sesskey, groupDatum $datum) {
    $res= $this->__call('add_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupingDatum $datum
   * @return groupingRecord[]
   */
  public function add_grouping($client, $sesskey, groupingDatum $datum) {
    $res= $this->__call('add_grouping', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param labelDatum $datum
   * @return labelRecord[]
   */
  public function add_label($client, $sesskey, labelDatum $datum) {
    $res= $this->__call('add_label', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function add_noneditingteacher($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('add_noneditingteacher', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param pageWikiDatum $datum
   * @return pageWikiRecord[]
   */
  public function add_pagewiki($client, $sesskey, pageWikiDatum $datum) {
    $res= $this->__call('add_pagewiki', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param sectionDatum $datum
   * @return sectionRecord[]
   */
  public function add_section($client, $sesskey, sectionDatum $datum) {
    $res= $this->__call('add_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function add_student($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('add_student', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function add_teacher($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('add_teacher', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param userDatum $userdatum
   * @return userRecord[]
   */
  public function add_user($client, $sesskey, userDatum $userdatum) {
    $res= $this->__call('add_user', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userdatum'=>$userdatum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param wikiDatum $datum
   * @return wikiRecord[]
   */
  public function add_wiki($client, $sesskey, wikiDatum $datum) {
    $res= $this->__call('add_wiki', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $assignmentid
   * @param int $sectionid
   * @param int $groupmode
   * @return affectRecord
   */
  public function affect_assignment_to_section($client, $sesskey, $assignmentid, $sectionid, $groupmode) {
    $res= $this->__call('affect_assignment_to_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'assignmentid'=>$assignmentid,
            'sectionid'=>$sectionid,
            'groupmode'=>$groupmode
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $courseid
   * @param int $categoryid
   * @return affectRecord
   */
  public function affect_course_to_category($client, $sesskey, $courseid, $categoryid) {
    $res= $this->__call('affect_course_to_category', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'categoryid'=>$categoryid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $databaseid
   * @param int $sectionid
   * @return affectRecord
   */
  public function affect_database_to_section($client, $sesskey, $databaseid, $sectionid) {
    $res= $this->__call('affect_database_to_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'databaseid'=>$databaseid,
            'sectionid'=>$sectionid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $forumid
   * @param int $sectionid
   * @param int $groupmode
   * @return affectRecord
   */
  public function affect_forum_to_section($client, $sesskey, $forumid, $sectionid, $groupmode) {
    $res= $this->__call('affect_forum_to_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'forumid'=>$forumid,
            'sectionid'=>$sectionid,
            'groupmode'=>$groupmode
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @param int $courseid
   * @return affectRecord
   */
  public function affect_group_to_course($client, $sesskey, $groupid, $courseid) {
    $res= $this->__call('affect_group_to_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid,
            'courseid'=>$courseid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @param int $groupingid
   * @return affectRecord
   */
  public function affect_group_to_grouping($client, $sesskey, $groupid, $groupingid) {
    $res= $this->__call('affect_group_to_grouping', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid,
            'groupingid'=>$groupingid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupingid
   * @param int $courseid
   * @return affectRecord
   */
  public function affect_grouping_to_course($client, $sesskey, $groupingid, $courseid) {
    $res= $this->__call('affect_grouping_to_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupingid'=>$groupingid,
            'courseid'=>$courseid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $labelid
   * @param int $sectionid
   * @return affectRecord
   */
  public function affect_label_to_section($client, $sesskey, $labelid, $sectionid) {
    $res= $this->__call('affect_label_to_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'labelid'=>$labelid,
            'sectionid'=>$sectionid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $pageid
   * @param int $wikiid
   * @return affectRecord
   */
  public function affect_pageWiki_to_wiki($client, $sesskey, $pageid, $wikiid) {
    $res= $this->__call('affect_pageWiki_to_wiki', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'pageid'=>$pageid,
            'wikiid'=>$wikiid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $sectionid
   * @param int $courseid
   * @return affectRecord
   */
  public function affect_section_to_course($client, $sesskey, $sectionid, $courseid) {
    $res= $this->__call('affect_section_to_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'sectionid'=>$sectionid,
            'courseid'=>$courseid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $groupid
   * @return affectRecord
   */
  public function affect_user_to_cohort($client, $sesskey, $userid, $groupid) {
    $res= $this->__call('affect_user_to_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'groupid'=>$groupid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $courseid
   * @param string $rolename
   * @return affectRecord
   */
  public function affect_user_to_course($client, $sesskey, $userid, $courseid, $rolename) {
    $res= $this->__call('affect_user_to_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'courseid'=>$courseid,
            'rolename'=>$rolename
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $groupid
   * @return affectRecord
   */
  public function affect_user_to_group($client, $sesskey, $userid, $groupid) {
    $res= $this->__call('affect_user_to_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'groupid'=>$groupid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $userids
   * @param string $useridfield
   * @param string $cohortid
   * @param string $cohortidfield
   * @return enrolRecord[]
   */
  public function affect_users_to_cohort($client, $sesskey, $userids, $useridfield, $cohortid, $cohortidfield) {
    $res= $this->__call('affect_users_to_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userids'=>$userids,
            'useridfield'=>$useridfield,
            'cohortid'=>$cohortid,
            'cohortidfield'=>$cohortidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $userids
   * @param string $useridfield
   * @param string $groupid
   * @param string $groupidfield
   * @return enrolRecord[]
   */
  public function affect_users_to_group($client, $sesskey, $userids, $useridfield, $groupid, $groupidfield) {
    $res= $this->__call('affect_users_to_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userids'=>$userids,
            'useridfield'=>$useridfield,
            'groupid'=>$groupid,
            'groupidfield'=>$groupidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $wikiid
   * @param int $sectionid
   * @param int $groupmode
   * @param int $visible
   * @return affectRecord
   */
  public function affect_wiki_to_section($client, $sesskey, $wikiid, $sectionid, $groupmode, $visible) {
    $res= $this->__call('affect_wiki_to_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'wikiid'=>$wikiid,
            'sectionid'=>$sectionid,
            'groupmode'=>$groupmode,
            'visible'=>$visible
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string $courseid
   * @param string $courseidfield
   * @param int $limit
   * @return int
   */
  public function count_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit) {
    $res= $this->__call('count_activities', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'limit'=>$limit
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @param int $roleid
   * @return int
   */
  public function count_users_bycourse($client, $sesskey, $courseid, $idfield, $roleid) {
    $res= $this->__call('count_users_bycourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield,
            'roleid'=>$roleid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @return cohortRecord[]
   */
  public function delete_cohort($client, $sesskey, $id, $idfield) {
    $res= $this->__call('delete_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'id'=>$id,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @return courseRecord[]
   */
  public function delete_course($client, $sesskey, $courseid, $courseidfield) {
    $res= $this->__call('delete_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @return groupRecord[]
   */
  public function delete_group($client, $sesskey, $id, $idfield) {
    $res= $this->__call('delete_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'id'=>$id,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @return groupingRecord[]
   */
  public function delete_grouping($client, $sesskey, $id, $idfield) {
    $res= $this->__call('delete_grouping', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'id'=>$id,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @return userRecord[]
   */
  public function delete_user($client, $sesskey, $userid, $useridfield) {
    $res= $this->__call('delete_user', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param assignmentDatum[] $assignments
   * @return assignmentRecord[]
   */
  public function edit_assignments($client, $sesskey, $assignments) {
    $res= $this->__call('edit_assignments', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'assignments'=>$assignments
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param categoryDatum[] $categories
   * @return categoryRecord[]
   */
  public function edit_categories($client, $sesskey, $categories) {
    $res= $this->__call('edit_categories', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'categories'=>$categories
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param courseDatum[] $courses
   * @return courseRecord[]
   */
  public function edit_courses($client, $sesskey, $courses) {
    $res= $this->__call('edit_courses', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courses'=>$courses
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param databaseDatum[] $databases
   * @return databaseRecord[]
   */
  public function edit_databases($client, $sesskey, $databases) {
    $res= $this->__call('edit_databases', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'databases'=>$databases
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param forumDatum[] $forums
   * @return forumRecord[]
   */
  public function edit_forums($client, $sesskey, $forums) {
    $res= $this->__call('edit_forums', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'forums'=>$forums
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupingDatum[] $groupings
   * @return groupingRecord[]
   */
  public function edit_groupings($client, $sesskey, $groupings) {
    $res= $this->__call('edit_groupings', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupings'=>$groupings
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupDatum[] $groups
   * @return groupRecord[]
   */
  public function edit_groups($client, $sesskey, $groups) {
    $res= $this->__call('edit_groups', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groups'=>$groups
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param labelDatum[] $labels
   * @return labelRecord[]
   */
  public function edit_labels($client, $sesskey, $labels) {
    $res= $this->__call('edit_labels', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'labels'=>$labels
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param pageWikiDatum[] $pageswiki
   * @return pageWikiRecord[]
   */
  public function edit_pagesWiki($client, $sesskey, $pageswiki) {
    $res= $this->__call('edit_pagesWiki', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'pageswiki'=>$pageswiki
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param sectionDatum[] $sections
   * @return sectionRecord[]
   */
  public function edit_sections($client, $sesskey, $sections) {
    $res= $this->__call('edit_sections', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'sections'=>$sections
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param userDatum[] $users
   * @return userRecord[]
   */
  public function edit_users($client, $sesskey, $users) {
    $res= $this->__call('edit_users', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'users'=>$users
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param wikiDatum[] $wikis
   * @return wikiRecord[]
   */
  public function edit_wikis($client, $sesskey, $wikis) {
    $res= $this->__call('edit_wikis', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'wikis'=>$wikis
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string[] $userids
   * @param string $idfield
   * @return enrolRecord[]
   */
  public function enrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield) {
    $res= $this->__call('enrol_students', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userids'=>$userids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param
   * @return void
   */
  public function exception_handler() {
    $res= $this->__call('exception_handler', array());
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $forumid
   * @param forumDiscussionDatum $discussion
   * @return forumDiscussionRecord[]
   */
  public function forum_add_discussion($client, $sesskey, $forumid, forumDiscussionDatum $discussion) {
    $res= $this->__call('forum_add_discussion', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'forumid'=>$forumid,
            'discussion'=>$discussion
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $parentid
   * @param forumPostDatum $post
   * @return forumPostRecord[]
   */
  public function forum_add_reply($client, $sesskey, $parentid, forumPostDatum $post) {
    $res= $this->__call('forum_add_reply', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'parentid'=>$parentid,
            'post'=>$post
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string $courseid
   * @param string $courseidfield
   * @param int $limit
   * @return activityRecord[]
   */
  public function get_activities($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $limit) {
    $res= $this->__call('get_activities', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'limit'=>$limit
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return assignmentRecord[]
   */
  public function get_all_assignments($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_assignments', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return cohortRecord[]
   */
  public function get_all_cohorts($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_cohorts', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return databaseRecord[]
   */
  public function get_all_databases($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_databases', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return forumRecord[]
   */
  public function get_all_forums($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_forums', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return groupingRecord[]
   */
  public function get_all_groupings($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_groupings', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return groupRecord[]
   */
  public function get_all_groups($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_groups', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return labelRecord[]
   */
  public function get_all_labels($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_labels', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return pageWikiRecord[]
   */
  public function get_all_pagesWiki($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_pagesWiki', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return quizRecord[]
   */
  public function get_all_quizzes($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_quizzes', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $fieldname
   * @param string $fieldvalue
   * @return wikiRecord[]
   */
  public function get_all_wikis($client, $sesskey, $fieldname, $fieldvalue) {
    $res= $this->__call('get_all_wikis', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'fieldname'=>$fieldname,
            'fieldvalue'=>$fieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $assignmentid
   * @param string[] $userids
   * @param string $useridfield
   * @param int $timemodified
   * @param int $zipfiles
   * @return assignmentSubmissionRecord[]
   */
  public function get_assignment_submissions($client, $sesskey, $assignmentid, $userids, $useridfield, $timemodified, $zipfiles) {
    $res= $this->__call('get_assignment_submissions', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'assignmentid'=>$assignmentid,
            'userids'=>$userids,
            'useridfield'=>$useridfield,
            'timemodified'=>$timemodified,
            'zipfiles'=>$zipfiles
      ));
   return $res;
  }

  /**
   *
   *
   * @param
   * @return boolean[]
   */
  public function get_boolean_array() {
    $res= $this->__call('get_boolean_array', array());
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $catid
   * @param string $idfield
   * @return categoryRecord[]
   */
  public function get_categories($client, $sesskey, $catid, $idfield) {
    $res= $this->__call('get_categories', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'catid'=>$catid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $catid
   * @return categoryRecord[]
   */
  public function get_category_byid($client, $sesskey, $catid) {
    $res= $this->__call('get_category_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'catid'=>$catid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $catname
   * @return categoryRecord[]
   */
  public function get_category_byname($client, $sesskey, $catname) {
    $res= $this->__call('get_category_byname', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'catname'=>$catname
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @return cohortRecord[]
   */
  public function get_cohort_byid($client, $sesskey, $groupid) {
    $res= $this->__call('get_cohort_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $cohortidnumber
   * @return cohortRecord[]
   */
  public function get_cohort_byidnumber($client, $sesskey, $cohortidnumber) {
    $res= $this->__call('get_cohort_byidnumber', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'cohortidnumber'=>$cohortidnumber
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $id
   * @param string $idfield
   * @return userRecord[]
   */
  public function get_cohort_members($client, $sesskey, $id, $idfield) {
    $res= $this->__call('get_cohort_members', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'id'=>$id,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $cohortname
   * @return cohortRecord[]
   */
  public function get_cohorts_byname($client, $sesskey, $cohortname) {
    $res= $this->__call('get_cohorts_byname', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'cohortname'=>$cohortname
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $info
   * @param string $idfield
   * @return courseRecord[]
   */
  public function get_course($client, $sesskey, $info, $idfield) {
    $res= $this->__call('get_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'info'=>$info,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $info
   * @return courseRecord[]
   */
  public function get_course_byid($client, $sesskey, $info) {
    $res= $this->__call('get_course_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'info'=>$info
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $info
   * @return courseRecord[]
   */
  public function get_course_byidnumber($client, $sesskey, $info) {
    $res= $this->__call('get_course_byidnumber', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'info'=>$info
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return gradeRecord[]
   */
  public function get_course_grades($client, $sesskey, $courseid, $idfield) {
    $res= $this->__call('get_course_grades', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $courseids
   * @param string $idfield
   * @return courseRecord[]
   */
  public function get_courses($client, $sesskey, $courseids, $idfield) {
    $res= $this->__call('get_courses', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseids'=>$courseids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $catid
   * @return courseRecord[]
   */
  public function get_courses_bycategory($client, $sesskey, $catid) {
    $res= $this->__call('get_courses_bycategory', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'catid'=>$catid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $search
   * @return courseRecord[]
   */
  public function get_courses_search($client, $sesskey, $search) {
    $res= $this->__call('get_courses_search', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'search'=>$search
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $eventtype
   * @param string $ownerid
   * @param string $owneridfield
   * @param int $datetimefrom
   * @return eventRecord[]
   */
  public function get_events($client, $sesskey, $eventtype, $ownerid, $owneridfield, $datetimefrom) {
    $res= $this->__call('get_events', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'eventtype'=>$eventtype,
            'ownerid'=>$ownerid,
            'owneridfield'=>$owneridfield,
            'datetimefrom'=>$datetimefrom
      ));
   return $res;
  }

  /**
   *
   *
   * @param float $n
   * @return float[]
   */
  public function get_float_array($n) {
    $res= $this->__call('get_float_array', array(
            'n'=>$n
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $forumid
   * @param int $limit
   * @return forumDiscussionRecord[]
   */
  public function get_forum_discussions($client, $sesskey, $forumid, $limit) {
    $res= $this->__call('get_forum_discussions', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'forumid'=>$forumid,
            'limit'=>$limit
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $discussionid
   * @param int $limit
   * @return forumPostRecord[]
   */
  public function get_forum_posts($client, $sesskey, $discussionid, $limit) {
    $res= $this->__call('get_forum_posts', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'discussionid'=>$discussionid,
            'limit'=>$limit
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string[] $courseids
   * @param string $courseidfield
   * @return gradeRecord[]
   */
  public function get_grades($client, $sesskey, $userid, $useridfield, $courseids, $courseidfield) {
    $res= $this->__call('get_grades', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'courseids'=>$courseids,
            'courseidfield'=>$courseidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @return groupRecord[]
   */
  public function get_group_byid($client, $sesskey, $groupid) {
    $res= $this->__call('get_group_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $groupid
   * @param string $groupidfield
   * @return userRecord[]
   */
  public function get_group_members($client, $sesskey, $groupid, $groupidfield) {
    $res= $this->__call('get_group_members', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid,
            'groupidfield'=>$groupidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @return groupRecord[]
   */
  public function get_grouping_byid($client, $sesskey, $groupid) {
    $res= $this->__call('get_grouping_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $groupid
   * @param string $groupidfield
   * @return userRecord[]
   */
  public function get_grouping_members($client, $sesskey, $groupid, $groupidfield) {
    $res= $this->__call('get_grouping_members', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid,
            'groupidfield'=>$groupidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return groupingRecord[]
   */
  public function get_groupings_bycourse($client, $sesskey, $courseid, $idfield) {
    $res= $this->__call('get_groupings_bycourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $groupname
   * @param int $courseid
   * @return groupRecord[]
   */
  public function get_groupings_byname($client, $sesskey, $groupname, $courseid) {
    $res= $this->__call('get_groupings_byname', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupname'=>$groupname,
            'courseid'=>$courseid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return groupRecord[]
   */
  public function get_groups_bycourse($client, $sesskey, $courseid, $idfield) {
    $res= $this->__call('get_groups_bycourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $groupname
   * @param int $courseid
   * @return groupRecord[]
   */
  public function get_groups_byname($client, $sesskey, $groupname, $courseid) {
    $res= $this->__call('get_groups_byname', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupname'=>$groupname,
            'courseid'=>$courseid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $courseids
   * @param string $idfield
   * @param string $type
   * @return resourceRecord[]
   */
  public function get_instances_bytype($client, $sesskey, $courseids, $idfield, $type) {
    $res= $this->__call('get_instances_bytype', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseids'=>$courseids,
            'idfield'=>$idfield,
            'type'=>$type
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $n
   * @return int[]
   */
  public function get_int_array($n) {
    $res= $this->__call('get_int_array', array(
            'n'=>$n
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @param int $limit
   * @return changeRecord[]
   */
  public function get_last_changes($client, $sesskey, $courseid, $idfield, $limit) {
    $res= $this->__call('get_last_changes', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield,
            'limit'=>$limit
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @return contactRecord[]
   */
  public function get_message_contacts($client, $sesskey, $userid, $useridfield) {
    $res= $this->__call('get_message_contacts', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @return messageRecord[]
   */
  public function get_messages($client, $sesskey, $userid, $useridfield) {
    $res= $this->__call('get_messages', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $useridto
   * @param string $useridtofield
   * @param string $useridfrom
   * @param string $useridfromfield
   * @return messageRecord[]
   */
  public function get_messages_history($client, $sesskey, $useridto, $useridtofield, $useridfrom, $useridfromfield) {
    $res= $this->__call('get_messages_history', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'useridto'=>$useridto,
            'useridtofield'=>$useridtofield,
            'useridfrom'=>$useridfrom,
            'useridfromfield'=>$useridfromfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $activityid
   * @param string $activitytype
   * @param string[] $userids
   * @param string $useridfield
   * @return gradeItemRecord[]
   */
  public function get_module_grades($client, $sesskey, $activityid, $activitytype, $userids, $useridfield) {
    $res= $this->__call('get_module_grades', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'activityid'=>$activityid,
            'activitytype'=>$activitytype,
            'userids'=>$userids,
            'useridfield'=>$useridfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $assignmentid
   * @return gradeItemRecord[]
   */
  public function get_my_assignment_grade($client, $sesskey, $assignmentid) {
    $res= $this->__call('get_my_assignment_grade', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'assignmentid'=>$assignmentid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $uid
   * @param string $idfield
   * @return cohortRecord[]
   */
  public function get_my_cohorts($client, $sesskey, $uid, $idfield) {
    $res= $this->__call('get_my_cohorts', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $uid
   * @param string $sort
   * @return courseRecord[]
   */
  public function get_my_courses($client, $sesskey, $uid, $sort) {
    $res= $this->__call('get_my_courses', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'sort'=>$sort
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $uid
   * @param string $sort
   * @return courseRecord[]
   */
  public function get_my_courses_byidnumber($client, $sesskey, $uid, $sort) {
    $res= $this->__call('get_my_courses_byidnumber', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'sort'=>$sort
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $uid
   * @param string $sort
   * @return courseRecord[]
   */
  public function get_my_courses_byusername($client, $sesskey, $uid, $sort) {
    $res= $this->__call('get_my_courses_byusername', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'sort'=>$sort
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $uid
   * @param int $idfield
   * @param string $courseid
   * @param string $courseidfield
   * @return groupRecord[]
   */
  public function get_my_group($client, $sesskey, $uid, $idfield, $courseid, $courseidfield) {
    $res= $this->__call('get_my_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'idfield'=>$idfield,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $uid
   * @param string $idfield
   * @return groupRecord[]
   */
  public function get_my_groups($client, $sesskey, $uid, $idfield) {
    $res= $this->__call('get_my_groups', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'uid'=>$uid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @return int
   */
  public function get_my_id($client, $sesskey) {
    $res= $this->__call('get_my_id', array(
            'client'=>$client,
            'sesskey'=>$sesskey
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $activityid
   * @param string $activitytype
   * @return gradeItemRecord[]
   */
  public function get_my_module_grade($client, $sesskey, $activityid, $activitytype) {
    $res= $this->__call('get_my_module_grade', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'activityid'=>$activityid,
            'activitytype'=>$activitytype
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $quizid
   * @return gradeItemRecord[]
   */
  public function get_my_quiz_grade($client, $sesskey, $quizid) {
    $res= $this->__call('get_my_quiz_grade', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'quizid'=>$quizid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string $courseid
   * @param string $courseidfield
   * @return int
   */
  public function get_primaryrole_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield) {
    $res= $this->__call('get_primaryrole_incourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $quizid
   * @param string $format
   * @return quizRecord
   */
  public function get_quiz($client, $sesskey, $quizid, $format) {
    $res= $this->__call('get_quiz', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'quizid'=>$quizid,
            'format'=>$format
      ));
  return $this->castTo ('quizRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $resourceid
   * @return fileRecord
   */
  public function get_resourcefile_byid($client, $sesskey, $resourceid) {
    $res= $this->__call('get_resourcefile_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'resourceid'=>$resourceid
      ));
  return $this->castTo ('fileRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $courseids
   * @param string $idfield
   * @return resourceRecord[]
   */
  public function get_resources($client, $sesskey, $courseids, $idfield) {
    $res= $this->__call('get_resources', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseids'=>$courseids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $roleid
   * @return roleRecord[]
   */
  public function get_role_byid($client, $sesskey, $roleid) {
    $res= $this->__call('get_role_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'roleid'=>$roleid
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $rolename
   * @return roleRecord[]
   */
  public function get_role_byname($client, $sesskey, $rolename) {
    $res= $this->__call('get_role_byname', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'rolename'=>$rolename
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $roleid
   * @param string $idfield
   * @return roleRecord[]
   */
  public function get_roles($client, $sesskey, $roleid, $idfield) {
    $res= $this->__call('get_roles', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'roleid'=>$roleid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $courseids
   * @param string $idfield
   * @return sectionRecord[]
   */
  public function get_sections($client, $sesskey, $courseids, $idfield) {
    $res= $this->__call('get_sections', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseids'=>$courseids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param
   * @return string[]
   */
  public function get_string_array() {
    $res= $this->__call('get_string_array', array());
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return userRecord[]
   */
  public function get_students($client, $sesskey, $courseid, $idfield) {
    $res= $this->__call('get_students', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $idfield
   * @return userRecord[]
   */
  public function get_teachers($client, $sesskey, $courseid, $idfield) {
    $res= $this->__call('get_teachers', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userinfo
   * @param string $idfield
   * @return userRecord[]
   */
  public function get_user($client, $sesskey, $userinfo, $idfield) {
    $res= $this->__call('get_user', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userinfo'=>$userinfo,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userinfo
   * @return userRecord[]
   */
  public function get_user_byid($client, $sesskey, $userinfo) {
    $res= $this->__call('get_user_byid', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userinfo'=>$userinfo
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userinfo
   * @return userRecord[]
   */
  public function get_user_byidnumber($client, $sesskey, $userinfo) {
    $res= $this->__call('get_user_byidnumber', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userinfo'=>$userinfo
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userinfo
   * @return userRecord[]
   */
  public function get_user_byusername($client, $sesskey, $userinfo) {
    $res= $this->__call('get_user_byusername', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userinfo'=>$userinfo
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $idfield
   * @return gradeRecord[]
   */
  public function get_user_grades($client, $sesskey, $userid, $idfield) {
    $res= $this->__call('get_user_grades', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $userids
   * @param string $idfield
   * @return userRecord[]
   */
  public function get_users($client, $sesskey, $userids, $idfield) {
    $res= $this->__call('get_users', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userids'=>$userids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $idcourse
   * @param string $idfield
   * @param int $idrole
   * @return userRecord[]
   */
  public function get_users_bycourse($client, $sesskey, $idcourse, $idfield, $idrole) {
    $res= $this->__call('get_users_bycourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'idcourse'=>$idcourse,
            'idfield'=>$idfield,
            'idrole'=>$idrole
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $profilefieldname
   * @param string $profilefieldvalue
   * @return userRecord[]
   */
  public function get_users_byprofile($client, $sesskey, $profilefieldname, $profilefieldvalue) {
    $res= $this->__call('get_users_byprofile', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'profilefieldname'=>$profilefieldname,
            'profilefieldvalue'=>$profilefieldvalue
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @return int
   */
  public function get_version($client, $sesskey) {
    $res= $this->__call('get_version', array(
            'client'=>$client,
            'sesskey'=>$sesskey
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string $courseid
   * @param string $courseidfield
   * @param int $roleid
   * @return boolean
   */
  public function has_role_incourse($client, $sesskey, $userid, $useridfield, $courseid, $courseidfield, $roleid) {
    $res= $this->__call('has_role_incourse', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'roleid'=>$roleid
      ));
   return $res;
  }

  /**
   *
   *
   * @param string $username
   * @param string $password
   * @return loginReturn
   */
  public function login($username, $password) {
    $res= $this->__call('login', array(
            'username'=>$username,
            'password'=>$password
      ));
  return $this->castTo ('loginReturn',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @return boolean
   */
  public function logout($client, $sesskey) {
    $res= $this->__call('logout', array(
            'client'=>$client,
            'sesskey'=>$sesskey
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param string $message
   * @return affectRecord
   */
  public function message_send($client, $sesskey, $userid, $useridfield, $message) {
    $res= $this->__call('message_send', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'message'=>$message
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $groupid
   * @param int $groupingid
   * @return affectRecord
   */
  public function remove_group_from_grouping($client, $sesskey, $groupid, $groupingid) {
    $res= $this->__call('remove_group_from_grouping', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'groupid'=>$groupid,
            'groupingid'=>$groupingid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function remove_noneditingteacher($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('remove_noneditingteacher', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function remove_student($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('remove_student', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string $userid
   * @param string $useridfield
   * @return affectRecord
   */
  public function remove_teacher($client, $sesskey, $courseid, $courseidfield, $userid, $useridfield) {
    $res= $this->__call('remove_teacher', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userid'=>$userid,
            'useridfield'=>$useridfield
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $groupid
   * @return affectRecord
   */
  public function remove_user_from_cohort($client, $sesskey, $userid, $groupid) {
    $res= $this->__call('remove_user_from_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'groupid'=>$groupid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $courseid
   * @param string $rolename
   * @return affectRecord
   */
  public function remove_user_from_course($client, $sesskey, $userid, $courseid, $rolename) {
    $res= $this->__call('remove_user_from_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'courseid'=>$courseid,
            'rolename'=>$rolename
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param int $userid
   * @param int $groupid
   * @return affectRecord
   */
  public function remove_user_from_group($client, $sesskey, $userid, $groupid) {
    $res= $this->__call('remove_user_from_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'groupid'=>$groupid
      ));
  return $this->castTo ('affectRecord',$res);
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $userids
   * @param string $useridfield
   * @param string $cohortid
   * @param string $cohortidfield
   * @return enrolRecord[]
   */
  public function remove_users_from_cohort($client, $sesskey, $userids, $useridfield, $cohortid, $cohortidfield) {
    $res= $this->__call('remove_users_from_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userids'=>$userids,
            'useridfield'=>$useridfield,
            'cohortid'=>$cohortid,
            'cohortidfield'=>$cohortidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string[] $userids
   * @param string $useridfield
   * @param string $groupid
   * @param string $groupidfield
   * @return enrolRecord[]
   */
  public function remove_users_from_group($client, $sesskey, $userids, $useridfield, $groupid, $groupidfield) {
    $res= $this->__call('remove_users_from_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userids'=>$userids,
            'useridfield'=>$useridfield,
            'groupid'=>$groupid,
            'groupidfield'=>$groupidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $userid
   * @param string $useridfield
   * @param profileitemRecord[] $values
   * @return profileitemRecord[]
   */
  public function set_user_profile_values($client, $sesskey, $userid, $useridfield, $values) {
    $res= $this->__call('set_user_profile_values', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'userid'=>$userid,
            'useridfield'=>$useridfield,
            'values'=>$values
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param string $courseid
   * @param string $courseidfield
   * @param string[] $userids
   * @param string $idfield
   * @return enrolRecord[]
   */
  public function unenrol_students($client, $sesskey, $courseid, $courseidfield, $userids, $idfield) {
    $res= $this->__call('unenrol_students', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'courseid'=>$courseid,
            'courseidfield'=>$courseidfield,
            'userids'=>$userids,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param cohortDatum $datum
   * @param string $idfield
   * @return cohortRecord[]
   */
  public function update_cohort($client, $sesskey, cohortDatum $datum, $idfield) {
    $res= $this->__call('update_cohort', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param courseDatum $datum
   * @param string $courseidfield
   * @return courseRecord[]
   */
  public function update_course($client, $sesskey, courseDatum $datum, $courseidfield) {
    $res= $this->__call('update_course', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'courseidfield'=>$courseidfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupDatum $datum
   * @param string $idfield
   * @return groupRecord[]
   */
  public function update_group($client, $sesskey, groupDatum $datum, $idfield) {
    $res= $this->__call('update_group', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param groupingDatum $datum
   * @param string $idfield
   * @return groupingRecord[]
   */
  public function update_grouping($client, $sesskey, groupingDatum $datum, $idfield) {
    $res= $this->__call('update_grouping', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param sectionDatum $datum
   * @param string $idfield
   * @return sectionRecord[]
   */
  public function update_section($client, $sesskey, sectionDatum $datum, $idfield) {
    $res= $this->__call('update_section', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'idfield'=>$idfield
      ));
   return $res;
  }

  /**
   *
   *
   * @param int $client
   * @param string $sesskey
   * @param userDatum $datum
   * @param string $useridfield
   * @return userRecord[]
   */
  public function update_user($client, $sesskey, userDatum $datum, $useridfield) {
    $res= $this->__call('update_user', array(
            'client'=>$client,
            'sesskey'=>$sesskey,
            'datum'=>$datum,
            'useridfield'=>$useridfield
      ));
   return $res;
  }

}

?>
