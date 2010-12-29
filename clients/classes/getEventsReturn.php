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
	* @param eventRecord[] $events
	* @return getEventsReturn
	*/
	 public function getEventsReturn($events=array()){
		 $this->events=$events   ;
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
