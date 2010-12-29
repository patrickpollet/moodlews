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

	/**
	* default constructor for class getEventsReturn
	* @return getEventsReturn
	*/	 public function getEventsReturn() {
		 $this->events=array();
	}
	/* get accessors */

	/**
	* @return eventRecord[]
	*/
	public function getEvents(){
		 return $this->events;
	}

	/*set accessors */

	/**
	* @param eventRecord[] $events
	* @return void
	*/
	public function setEvents($events){
		$this->events=$events;
	}

}

?>
