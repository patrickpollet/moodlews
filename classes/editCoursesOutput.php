<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesOutput {
	/** 
	* @var courseRecord[]
	*/
	public $courses;

	/**
	* default constructor for class editCoursesOutput
	* @return editCoursesOutput
	*/	 public function editCoursesOutput() {
		 $this->courses=array();
	}
	/* get accessors */

	/**
	* @return courseRecord[]
	*/
	public function getCourses(){
		 return $this->courses;
	}

	/*set accessors */

	/**
	* @param courseRecord[] $courses
	* @return void
	*/
	public function setCourses($courses){
		$this->courses=$courses;
	}

}

?>
