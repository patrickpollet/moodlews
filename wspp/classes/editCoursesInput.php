<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesInput {
	/** 
	* @var courseDatum[]
	*/
	public $courses;

	/**
	* default constructor for class editCoursesInput
	* @return editCoursesInput
	*/	 public function editCoursesInput() {
		 $this->courses=array();
	}
	/* get accessors */

	/**
	* @return courseDatum[]
	*/
	public function getCourses(){
		 return $this->courses;
	}

	/*set accessors */

	/**
	* @param courseDatum[] $courses
	* @return void
	*/
	public function setCourses($courses){
		$this->courses=$courses;
	}

}

?>
