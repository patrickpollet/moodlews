<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editAssignmentsOutput {
	/** 
	* @var  (assignmentRecords) array of assignmentRecord
	*/
	public $assignments;
	 public function editAssignmentsOutput() {
		 $this->assignments=array();
	}
	/* get accessors */
	public function getAssignments(){
		 return $this->assignments;
	}

	/*set accessors */
	public function setAssignments($assignments){
		$this->assignments=$assignments;
	}

}

?>
