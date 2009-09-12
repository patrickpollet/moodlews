<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getActivitiesReturn {
	/** 
	* @var  (activityRecords) array of activityRecord
	*/
	public $activities;
	/* full constructor */
	 public function getActivitiesReturn($activities=array()){
		 $this->activities=$activities   ;
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
