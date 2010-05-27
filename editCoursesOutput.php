<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesOutput {
	/** 
	* @var  (courseRecords) array of courseRecord
	*/
	public $courses;
	 public function editCoursesOutput() {
		 $this->courses=array();
	}
	/* get accessors */
	public function getCourses(){
		 return $this->courses;
	}

	/*set accessors */
	public function setCourses($courses){
		$this->courses=$courses;
	}

}

?>
