<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getActivitiesReturn {
	/** 
	* @var  activityRecords
	*/
	public $activities;
	/* constructor */
	 public function getActivitiesReturn() {
		 $this->activities=new activityRecords();
	}
}

?>
