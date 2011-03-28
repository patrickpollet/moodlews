<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class eventRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var int
	*/
	public $format;
	/** 
	* @var int
	*/
	public $courseid;
	/** 
	* @var int
	*/
	public $groupid;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $repeatid;
	/** 
	* @var string
	*/
	public $modulename;
	/** 
	* @var int
	*/
	public $instance;
	/** 
	* @var string
	*/
	public $eventtype;
	/** 
	* @var int
	*/
	public $timestart;
	/** 
	* @var int
	*/
	public $timeduration;
	/** 
	* @var int
	*/
	public $visible;
	/** 
	* @var string
	*/
	public $uuid;
	/** 
	* @var int
	*/
	public $sequence;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class eventRecord
	* @param string $error
	* @param int $id
	* @param string $name
	* @param string $description
	* @param int $format
	* @param int $courseid
	* @param int $groupid
	* @param int $userid
	* @param int $repeatid
	* @param string $modulename
	* @param int $instance
	* @param string $eventtype
	* @param int $timestart
	* @param int $timeduration
	* @param int $visible
	* @param string $uuid
	* @param int $sequence
	* @param int $timemodified
	* @return eventRecord
	*/
	 public function eventRecord($error='',$id=0,$name='',$description='',$format=0,$courseid=0,$groupid=0,$userid=0,$repeatid=0,$modulename='',$instance=0,$eventtype='',$timestart=0,$timeduration=0,$visible=0,$uuid='',$sequence=0,$timemodified=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->format=$format   ;
		 $this->courseid=$courseid   ;
		 $this->groupid=$groupid   ;
		 $this->userid=$userid   ;
		 $this->repeatid=$repeatid   ;
		 $this->modulename=$modulename   ;
		 $this->instance=$instance   ;
		 $this->eventtype=$eventtype   ;
		 $this->timestart=$timestart   ;
		 $this->timeduration=$timeduration   ;
		 $this->visible=$visible   ;
		 $this->uuid=$uuid   ;
		 $this->sequence=$sequence   ;
		 $this->timemodified=$timemodified   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
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
	public function getCourseid(){
		 return $this->courseid;
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
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return int
	*/
	public function getRepeatid(){
		 return $this->repeatid;
	}


	/**
	* @return string
	*/
	public function getModulename(){
		 return $this->modulename;
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
	public function getEventtype(){
		 return $this->eventtype;
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
	public function getTimeduration(){
		 return $this->timeduration;
	}


	/**
	* @return int
	*/
	public function getVisible(){
		 return $this->visible;
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
	public function getSequence(){
		 return $this->sequence;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */

	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param int $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param int $groupid
	* @return void
	*/
	public function setGroupid($groupid){
		$this->groupid=$groupid;
	}


	/**
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param int $repeatid
	* @return void
	*/
	public function setRepeatid($repeatid){
		$this->repeatid=$repeatid;
	}


	/**
	* @param string $modulename
	* @return void
	*/
	public function setModulename($modulename){
		$this->modulename=$modulename;
	}


	/**
	* @param int $instance
	* @return void
	*/
	public function setInstance($instance){
		$this->instance=$instance;
	}


	/**
	* @param string $eventtype
	* @return void
	*/
	public function setEventtype($eventtype){
		$this->eventtype=$eventtype;
	}


	/**
	* @param int $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param int $timeduration
	* @return void
	*/
	public function setTimeduration($timeduration){
		$this->timeduration=$timeduration;
	}


	/**
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param string $uuid
	* @return void
	*/
	public function setUuid($uuid){
		$this->uuid=$uuid;
	}


	/**
	* @param int $sequence
	* @return void
	*/
	public function setSequence($sequence){
		$this->sequence=$sequence;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
