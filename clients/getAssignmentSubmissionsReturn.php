<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAssignmentSubmissionsReturn {
	/** 
	* @var  (assignmentSubmissionRecords) array of assignmentSubmissionRecord
	*/
	public $submissions;
	/* full constructor */
	 public function getAssignmentSubmissionsReturn($submissions=array()){
		 $this->submissions=$submissions   ;
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
