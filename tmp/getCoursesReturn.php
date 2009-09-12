<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getCoursesReturn {
	/** 
	* @var  courseRecords
	*/
	public $courses;
	/* constructor */
	 public function getCoursesReturn() {
		 $this->courses=new courseRecords();
	}
}

?>
