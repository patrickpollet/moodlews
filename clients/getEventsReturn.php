<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getEventsReturn {
	/** 
	* @var  (eventRecords) array of eventRecord
	*/
	public $events;
	/* full constructor */
	 public function getEventsReturn($events=array()){
		 $this->events=$events   ;
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
