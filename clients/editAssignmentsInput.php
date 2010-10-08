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
	/* full constructor */
	 public function editAssignmentsInput($assignments=array()){
		 $this->assignments=$assignments   ;
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
