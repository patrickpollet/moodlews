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
	* @var  (studentRecords) array of studentRecord
	*/
	public $students;
	/* full constructor */
	 public function enrolStudentsReturn($error='',$students=array()){
		 $this->error=$error   ;
		 $this->students=$students   ;
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
