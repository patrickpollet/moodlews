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
	 public function getAllAssignmentsReturn() {
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
