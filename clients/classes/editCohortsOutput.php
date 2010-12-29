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

	/**
	* default constructor for class editCohortsOutput
	* @param cohortRecord[] $cohorts
	* @return editCohortsOutput
	*/
	 public function editCohortsOutput($cohorts=array()){
		 $this->cohorts=$cohorts   ;
	}
	/* get accessors */

	/**
	* @return cohortRecord[]
	*/
	public function getCohorts(){
		 return $this->cohorts;
	}

	/*set accessors */

	/**
	* @param cohortRecord[] $cohorts
	* @return void
	*/
	public function setCohorts($cohorts){
		$this->cohorts=$cohorts;
	}

}

?>
