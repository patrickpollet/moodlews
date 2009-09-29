<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editAssignmentsInput {
	/** 
	* @var  (assignmentData) array of assignmentDatum
	*/
	public $assignments;
	 public function editAssignmentsInput() {
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
