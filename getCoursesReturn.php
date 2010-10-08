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
	 public function getCoursesReturn() {
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
