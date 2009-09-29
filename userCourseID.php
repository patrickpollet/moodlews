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
	 public function userCourseID() {
		 $this->courseid='';
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
