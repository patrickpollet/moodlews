<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesInput {
	/** 
	* @var  (courseData) array of courseDatum
	*/
	public $courses;
	 public function editCoursesInput() {
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
