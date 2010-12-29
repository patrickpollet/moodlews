<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGradesReturn {
	/** 
	* @var gradeRecord[]
	*/
	public $grades;

	/**
	* default constructor for class getGradesReturn
	* @return getGradesReturn
	*/	 public function getGradesReturn() {
		 $this->grades=array();
	}
	/* get accessors */

	/**
	* @return gradeRecord[]
	*/
	public function getGrades(){
		 return $this->grades;
	}

	/*set accessors */

	/**
	* @param gradeRecord[] $grades
	* @return void
	*/
	public function setGrades($grades){
		$this->grades=$grades;
	}

}

?>
