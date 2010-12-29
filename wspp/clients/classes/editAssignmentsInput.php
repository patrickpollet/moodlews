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
	* @param assignmentDatum[] $assignments
	* @return editAssignmentsInput
	*/
	 public function editAssignmentsInput($assignments=array()){
		 $this->assignments=$assignments   ;
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
