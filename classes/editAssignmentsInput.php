<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editAssignmentsInput {
	/** 
	* @var assignmentDatum[]
	*/
	public $assignments;

	/**
	* default constructor for class editAssignmentsInput
	* @return editAssignmentsInput
	*/	 public function editAssignmentsInput() {
		 $this->assignments=array();
	}
	/* get accessors */

	/**
	* @return assignmentDatum[]
	*/
	public function getAssignments(){
		 return $this->assignments;
	}

	/*set accessors */

	/**
	* @param assignmentDatum[] $assignments
	* @return void
	*/
	public function setAssignments($assignments){
		$this->assignments=$assignments;
	}

}

?>
