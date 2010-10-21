<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCohortsOutput {
	/** 
	* @var cohortRecord[]
	*/
	public $cohorts;
	 public function editCohortsOutput() {
		 $this->cohorts=array();
	}
	/* get accessors */
	public function getCohorts(){
		 return $this->cohorts;
	}

	/*set accessors */
	public function setCohorts($cohorts){
		$this->cohorts=$cohorts;
	}

}

?>
