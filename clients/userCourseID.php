<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class userCourseID {
	/** 
	* @var  string
	*/
	public $courseid;
	/* full constructor */
	 public function userCourseID($courseid=''){
		 $this->courseid=$courseid   ;
	}
	/* get accessors */
	public function getCourseid(){
		 return $this->courseid;
	}

	/*set accessors */
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}

}

?>
