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
	* @param courseDatum[] $courses
	* @return editCoursesInput
	*/
	 public function editCoursesInput($courses=array()){
		 $this->courses=$courses   ;
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
