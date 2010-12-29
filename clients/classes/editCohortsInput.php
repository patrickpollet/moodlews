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

	/**
	* default constructor for class editCohortsInput
	* @param cohortDatum[] $cohorts
	* @return editCohortsInput
	*/
	 public function editCohortsInput($cohorts=array()){
		 $this->cohorts=$cohorts   ;
	}
	/* get accessors */

	/**
	* @return cohortDatum[]
	*/
	public function getCohorts(){
		 return $this->cohorts;
	}

	/*set accessors */

	/**
	* @param cohortDatum[] $cohorts
	* @return void
	*/
	public function setCohorts($cohorts){
		$this->cohorts=$cohorts;
	}

}

?>
