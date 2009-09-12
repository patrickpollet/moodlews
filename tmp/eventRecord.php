<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class eventRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $format;
	/** 
	* @var  integer
	*/
	public $courseid;
	/** 
	* @var  integer
	*/
	public $groupid;
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  integer
	*/
	public $repeatid;
	/** 
	* @var  string
	*/
	public $modulename;
	/** 
	* @var  integer
	*/
	public $instance;
	/** 
	* @var  string
	*/
	public $eventtype;
	/** 
	* @var  integer
	*/
	public $timestart;
	/** 
	* @var  integer
	*/
	public $timeduration;
	/** 
	* @var  integer
	*/
	public $visible;
	/** 
	* @var  string
	*/
	public $uuid;
	/** 
	* @var  integer
	*/
	public $sequence;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/* constructor */
	 public function eventRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->name='';
		 $this->description='';
		 $this->format=0;
		 $this->courseid=0;
		 $this->groupid=0;
		 $this->userid=0;
		 $this->repeatid=0;
		 $this->modulename='';
		 $this->instance=0;
		 $this->eventtype='';
		 $this->timestart=0;
		 $this->timeduration=0;
		 $this->visible=0;
		 $this->uuid='';
		 $this->sequence=0;
		 $this->timemodified=0;
	}
}

?>
