<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGradesReturn {
	/** 
	* @var  (studentGradeRecords) array of studentGradeRecord
	*/
	public $grades;
	 public function getGradesReturn() {
		 $this->grades=array();
	}
	/* get accessors */
	public function getGrades(){
		 return $this->grades;
	}

	/*set accessors */
	public function setGrades($grades){
		$this->grades=$grades;
	}

}

?>
