<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getEventsReturn {
	/** 
	* @var eventRecord[]
	*/
	public $events;
	 public function getEventsReturn() {
		 $this->events=array();
	}
	/* get accessors */
	public function getEvents(){
		 return $this->events;
	}

	/*set accessors */
	public function setEvents($events){
		$this->events=$events;
	}

}

?>
