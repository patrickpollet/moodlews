<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getModuleGradesReturn {
	/** 
	* @var gradeItemRecord[]
	*/
	public $grades;

	/**
	* default constructor for class getModuleGradesReturn
	* @param gradeItemRecord[] $grades
	* @return getModuleGradesReturn
	*/
	 public function getModuleGradesReturn($grades=array()){
		 $this->grades=$grades   ;
	}
	/* get accessors */

	/**
	* @return gradeItemRecord[]
	*/
	public function getGrades(){
		 return $this->grades;
	}

	/*set accessors */

	/**
	* @param gradeItemRecord[] $grades
	* @return void
	*/
	public function setGrades($grades){
		$this->grades=$grades;
	}

}

?>
