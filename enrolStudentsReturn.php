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
	* @var  (enrolRecords) array of enrolRecord
	*/
	public $students;
	 public function enrolStudentsReturn() {
		 $this->error='';
		 $this->students=array();
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getStudents(){
		 return $this->students;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setStudents($students){
		$this->students=$students;
	}

}

?>
