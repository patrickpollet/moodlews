<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllAssignmentsReturn {
	/** 
	* @var assignmentRecord[]
	*/
	public $assignments;

	/**
	* default constructor for class getAllAssignmentsReturn
	* @param assignmentRecord[] $assignments
	* @return getAllAssignmentsReturn
	*/
	 public function getAllAssignmentsReturn($assignments=array()){
		 $this->assignments=$assignments   ;
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
