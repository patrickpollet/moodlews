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

	/**
	* default constructor for class getAssignmentSubmissionsReturn
	* @return getAssignmentSubmissionsReturn
	*/	 public function getAssignmentSubmissionsReturn() {
		 $this->submissions=array();
	}
	/* get accessors */

	/**
	* @return assignmentSubmissionRecord[]
	*/
	public function getSubmissions(){
		 return $this->submissions;
	}

	/*set accessors */

	/**
	* @param assignmentSubmissionRecord[] $submissions
	* @return void
	*/
	public function setSubmissions($submissions){
		$this->submissions=$submissions;
	}

}

?>
