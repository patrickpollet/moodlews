<?php
/**
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
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getFormat(){
		 return $this->format;
	}

	public function getCourseid(){
		 return $this->courseid;
	}

	public function getGroupid(){
		 return $this->groupid;
	}

	public function getUserid(){
		 return $this->userid;
	}

	public function getRepeatid(){
		 return $this->repeatid;
	}

	public function getModulename(){
		 return $this->modulename;
	}

	public function getInstance(){
		 return $this->instance;
	}

	public function getEventtype(){
		 return $this->eventtype;
	}

	public function getTimestart(){
		 return $this->timestart;
	}

	public function getTimeduration(){
		 return $this->timeduration;
	}

	public function getVisible(){
		 return $this->visible;
	}

	public function getUuid(){
		 return $this->uuid;
	}

	public function getSequence(){
		 return $this->sequence;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setFormat($format){
		$this->format=$format;
	}

	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}

	public function setGroupid($groupid){
		$this->groupid=$groupid;
	}

	public function setUserid($userid){
		$this->userid=$userid;
	}

	public function setRepeatid($repeatid){
		$this->repeatid=$repeatid;
	}

	public function setModulename($modulename){
		$this->modulename=$modulename;
	}

	public function setInstance($instance){
		$this->instance=$instance;
	}

	public function setEventtype($eventtype){
		$this->eventtype=$eventtype;
	}

	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}

	public function setTimeduration($timeduration){
		$this->timeduration=$timeduration;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

	public function setUuid($uuid){
		$this->uuid=$uuid;
	}

	public function setSequence($sequence){
		$this->sequence=$sequence;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
