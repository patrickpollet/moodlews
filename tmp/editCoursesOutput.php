<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCoursesOutput {
	/** 
	* @var  courseRecords
	*/
	public $courses;
	/* constructor */
	 public function editCoursesOutput() {
		 $this->courses=new courseRecords();
	}
}

?>
