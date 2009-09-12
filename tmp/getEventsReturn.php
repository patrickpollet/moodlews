<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getEventsReturn {
	/** 
	* @var  eventRecords
	*/
	public $events;
	/* constructor */
	 public function getEventsReturn() {
		 $this->events=new eventRecords();
	}
}

?>
