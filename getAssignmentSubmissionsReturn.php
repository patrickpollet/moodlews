<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAssignmentSubmissionsReturn {
	/** 
	* @var assignmentSubmissionRecord[]
	*/
	public $submissions;
	 public function getAssignmentSubmissionsReturn() {
		 $this->submissions=array();
	}
	/* get accessors */
	public function getSubmissions(){
		 return $this->submissions;
	}

	/*set accessors */
	public function setSubmissions($submissions){
		$this->submissions=$submissions;
	}

}

?>
