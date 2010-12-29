<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editAssignmentsOutput {
	/** 
	* @var assignmentRecord[]
	*/
	public $assignments;

	/**
	* default constructor for class editAssignmentsOutput
	* @return editAssignmentsOutput
	*/	 public function editAssignmentsOutput() {
		 $this->assignments=array();
	}
	/* get accessors */

	/**
	* @return assignmentRecord[]
	*/
	public function getAssignments(){
		 return $this->assignments;
	}

	/*set accessors */

	/**
	* @param assignmentRecord[] $assignments
	* @return void
	*/
	public function setAssignments($assignments){
		$this->assignments=$assignments;
	}

}

?>
