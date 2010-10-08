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
	 public function getActivitiesReturn() {
		 $this->activities=array();
	}
	/* get accessors */
	public function getActivities(){
		 return $this->activities;
	}

	/*set accessors */
	public function setActivities($activities){
		$this->activities=$activities;
	}

}

?>
