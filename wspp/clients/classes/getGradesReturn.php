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
	* @param gradeRecord[] $grades
	* @return getGradesReturn
	*/
	 public function getGradesReturn($grades=array()){
		 $this->grades=$grades   ;
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
