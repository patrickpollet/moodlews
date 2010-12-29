<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getActivitiesReturn {
	/** 
	* @var activityRecord[]
	*/
	public $activities;

	/**
	* default constructor for class getActivitiesReturn
	* @return getActivitiesReturn
	*/	 public function getActivitiesReturn() {
		 $this->activities=array();
	}
	/* get accessors */

	/**
	* @return activityRecord[]
	*/
	public function getActivities(){
		 return $this->activities;
	}

	/*set accessors */

	/**
	* @param activityRecord[] $activities
	* @return void
	*/
	public function setActivities($activities){
		$this->activities=$activities;
	}

}

?>
