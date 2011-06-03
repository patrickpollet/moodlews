<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class eventRecord {
	/** 
	* @var int
	*/
	public $courseid;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var string
	*/
	public $eventtype;
	/** 
	* @var int
	*/
	public $format;
	/** 
	* @var int
	*/
	public $groupid;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $instance;
	/** 
	* @var string
	*/
	public $modulename;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $repeatid;
	/** 
	* @var int
	*/
	public $sequence;
	/** 
	* @var int
	*/
	public $timeduration;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
	*/
	public $timestart;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var string
	*/
	public $uuid;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class eventRecord
	* @param int $courseid
	* @param string $description
	* @param string $error
	* @param string $eventtype
	* @param int $format
	* @param int $groupid
	* @param int $id
	* @param int $instance
	* @param string $modulename
	* @param string $name
	* @param int $repeatid
	* @param int $sequence
	* @param int $timeduration
	* @param int $timemodified
	* @param int $timestart
	* @param int $userid
	* @param string $uuid
	* @param int $visible
	* @return eventRecord
	*/
	 public function eventRecord($courseid=0,$description='',$error='',$eventtype='',$format=0,$groupid=0,$id=0,$instance=0,$modulename='',$name='',$repeatid=0,$sequence=0,$timeduration=0,$timemodified=0,$timestart=0,$userid=0,$uuid='',$visible=0){
		 $this->courseid=$courseid   ;
		 $this->description=$description   ;
		 $this->error=$error   ;
		 $this->eventtype=$eventtype   ;
		 $this->format=$format   ;
		 $this->groupid=$groupid   ;
		 $this->id=$id   ;
		 $this->instance=$instance   ;
		 $this->modulename=$modulename   ;
		 $this->name=$name   ;
		 $this->repeatid=$repeatid   ;
		 $this->sequence=$sequence   ;
		 $this->timeduration=$timeduration   ;
		 $this->timemodified=$timemodified   ;
		 $this->timestart=$timestart   ;
		 $this->userid=$userid   ;
		 $this->uuid=$uuid   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getCourseid(){
		 return $this->courseid;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return string
	*/
	public function getEventtype(){
		 return $this->eventtype;
	}


	/**
	* @return int
	*/
	public function getFormat(){
		 return $this->format;
	}


	/**
	* @return int
	*/
	public function getGroupid(){
		 return $this->groupid;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return int
	*/
	public function getInstance(){
		 return $this->instance;
	}


	/**
	* @return string
	*/
	public function getModulename(){
		 return $this->modulename;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return int
	*/
	public function getRepeatid(){
		 return $this->repeatid;
	}


	/**
	* @return int
	*/
	public function getSequence(){
		 return $this->sequence;
	}


	/**
	* @return int
	*/
	public function getTimeduration(){
		 return $this->timeduration;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return int
	*/
	public function getTimestart(){
		 return $this->timestart;
	}


	/**
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return string
	*/
	public function getUuid(){
		 return $this->uuid;
	}


	/**
	* @return int
	*/
	public function getVisible(){
		 return $this->visible;
	}

	/*set accessors */

	/**
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param string $eventtype
	* @return void
	*/
	public function setEventtype($eventtype){
		$this->eventtype=$eventtype;
	}


	/**
	* @param int $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param int $groupid
	* @return void
	*/
	public function setGroupid($groupid){
		$this->groupid=$groupid;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $instance
	* @return void
	*/
	public function setInstance($instance){
		$this->instance=$instance;
	}


	/**
	* @param string $modulename
	* @return void
	*/
	public function setModulename($modulename){
		$this->modulename=$modulename;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param int $repeatid
	* @return void
	*/
	public function setRepeatid($repeatid){
		$this->repeatid=$repeatid;
	}


	/**
	* @param int $sequence
	* @return void
	*/
	public function setSequence($sequence){
		$this->sequence=$sequence;
	}


	/**
	* @param int $timeduration
	* @return void
	*/
	public function setTimeduration($timeduration){
		$this->timeduration=$timeduration;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param int $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param string $uuid
	* @return void
	*/
	public function setUuid($uuid){
		$this->uuid=$uuid;
	}


	/**
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
