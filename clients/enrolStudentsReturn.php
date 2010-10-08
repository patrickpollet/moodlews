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
	/* full constructor */
	 public function enrolStudentsReturn($students=array()){
		 $this->students=$students   ;
	}
	/* get accessors */
	public function getStudents(){
		 return $this->students;
	}

	/*set accessors */
	public function setStudents($students){
		$this->students=$students;
	}

}

?>
