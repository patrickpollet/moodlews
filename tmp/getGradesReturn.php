<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGradesReturn {
	/** 
	* @var  studentGradeRecords
	*/
	public $grades;
	/* constructor */
	 public function getGradesReturn() {
		 $this->grades=new studentGradeRecords();
	}
}

?>
