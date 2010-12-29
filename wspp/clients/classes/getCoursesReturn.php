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
	* @param courseRecord[] $courses
	* @return getCoursesReturn
	*/
	 public function getCoursesReturn($courses=array()){
		 $this->courses=$courses   ;
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
