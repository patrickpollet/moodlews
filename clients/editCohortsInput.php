<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCohortsInput {
	/** 
	* @var cohortDatum[]
	*/
	public $cohorts;
	/* full constructor */
	 public function editCohortsInput($cohorts=array()){
		 $this->cohorts=$cohorts   ;
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
