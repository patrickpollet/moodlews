<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class enrolStudentsReturn {
	/** 
	* @var enrolRecord[]
	*/
	public $students;

	/**
	* default constructor for class enrolStudentsReturn
	* @return enrolStudentsReturn
	*/	 public function enrolStudentsReturn() {
		 $this->students=array();
	}
	/* get accessors */

	/**
	* @return enrolRecord[]
	*/
	public function getStudents(){
		 return $this->students;
	}

	/*set accessors */

	/**
	* @param enrolRecord[] $students
	* @return void
	*/
	public function setStudents($students){
		$this->students=$students;
	}

}

?>
