<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class enrolStudentsReturn {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  studentRecords
	*/
	public $students;
	/* constructor */
	 public function enrolStudentsReturn() {
		 $this->error='';
		 $this->students=new studentRecords();
	}
}

?>
