<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getCoursesReturn {
	/** 
	* @var courseRecord[]
	*/
	public $courses;

	/**
	* default constructor for class getCoursesReturn
	* @return getCoursesReturn
	*/	 public function getCoursesReturn() {
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
