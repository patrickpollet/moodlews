<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesInput {
	/** 
	* @var  courseData
	*/
	public $courses;
	/* constructor */
	 public function editCoursesInput() {
		 $this->courses=new courseData();
	}
}

?>
