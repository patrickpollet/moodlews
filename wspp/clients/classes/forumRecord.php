<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $type;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $intro;
	/** 
	* @var int
	*/
	public $assessed;
	/** 
	* @var int
	*/
	public $assesstimestart;
	/** 
	* @var int
	*/
	public $assesstimefinish;
	/** 
	* @var int
	*/
	public $scale;
	/** 
	* @var int
	*/
	public $maxbytes;
	/** 
	* @var int
	*/
	public $forcesubscribe;
	/** 
	* @var int
	*/
	public $trackingtype;
	/** 
	* @var int
	*/
	public $rsstype;
	/** 
	* @var int
	*/
	public $rssarticles;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
	*/
	public $warnafter;
	/** 
	* @var int
	*/
	public $blockafter;
	/** 
	* @var int
	*/
	public $blockperiod;

	/**
	* default constructor for class forumRecord
	* @param string $error
	* @param int $id
	* @param int $course
	* @param string $type
	* @param string $name
	* @param string $intro
	* @param int $assessed
	* @param int $assesstimestart
	* @param int $assesstimefinish
	* @param int $scale
	* @param int $maxbytes
	* @param int $forcesubscribe
	* @param int $trackingtype
	* @param int $rsstype
	* @param int $rssarticles
	* @param int $timemodified
	* @param int $warnafter
	* @param int $blockafter
	* @param int $blockperiod
	* @return forumRecord
	*/
	 public function forumRecord($error='',$id=0,$course=0,$type='',$name='',$intro='',$assessed=0,$assesstimestart=0,$assesstimefinish=0,$scale=0,$maxbytes=0,$forcesubscribe=0,$trackingtype=0,$rsstype=0,$rssarticles=0,$timemodified=0,$warnafter=0,$blockafter=0,$blockperiod=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->type=$type   ;
		 $this->name=$name   ;
		 $this->intro=$intro   ;
		 $this->assessed=$assessed   ;
		 $this->assesstimestart=$assesstimestart   ;
		 $this->assesstimefinish=$assesstimefinish   ;
		 $this->scale=$scale   ;
		 $this->maxbytes=$maxbytes   ;
		 $this->forcesubscribe=$forcesubscribe   ;
		 $this->trackingtype=$trackingtype   ;
		 $this->rsstype=$rsstype   ;
		 $this->rssarticles=$rssarticles   ;
		 $this->timemodified=$timemodified   ;
		 $this->warnafter=$warnafter   ;
		 $this->blockafter=$blockafter   ;
		 $this->blockperiod=$blockperiod   ;
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
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return string
	*/
	public function getType(){
		 return $this->type;
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
	public function getIntro(){
		 return $this->intro;
	}


	/**
	* @return int
	*/
	public function getAssessed(){
		 return $this->assessed;
	}


	/**
	* @return int
	*/
	public function getAssesstimestart(){
		 return $this->assesstimestart;
	}


	/**
	* @return int
	*/
	public function getAssesstimefinish(){
		 return $this->assesstimefinish;
	}


	/**
	* @return int
	*/
	public function getScale(){
		 return $this->scale;
	}


	/**
	* @return int
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
	}


	/**
	* @return int
	*/
	public function getForcesubscribe(){
		 return $this->forcesubscribe;
	}


	/**
	* @return int
	*/
	public function getTrackingtype(){
		 return $this->trackingtype;
	}


	/**
	* @return int
	*/
	public function getRsstype(){
		 return $this->rsstype;
	}


	/**
	* @return int
	*/
	public function getRssarticles(){
		 return $this->rssarticles;
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
	public function getWarnafter(){
		 return $this->warnafter;
	}


	/**
	* @return int
	*/
	public function getBlockafter(){
		 return $this->blockafter;
	}


	/**
	* @return int
	*/
	public function getBlockperiod(){
		 return $this->blockperiod;
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
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $type
	* @return void
	*/
	public function setType($type){
		$this->type=$type;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param int $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param int $assesstimestart
	* @return void
	*/
	public function setAssesstimestart($assesstimestart){
		$this->assesstimestart=$assesstimestart;
	}


	/**
	* @param int $assesstimefinish
	* @return void
	*/
	public function setAssesstimefinish($assesstimefinish){
		$this->assesstimefinish=$assesstimefinish;
	}


	/**
	* @param int $scale
	* @return void
	*/
	public function setScale($scale){
		$this->scale=$scale;
	}


	/**
	* @param int $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param int $forcesubscribe
	* @return void
	*/
	public function setForcesubscribe($forcesubscribe){
		$this->forcesubscribe=$forcesubscribe;
	}


	/**
	* @param int $trackingtype
	* @return void
	*/
	public function setTrackingtype($trackingtype){
		$this->trackingtype=$trackingtype;
	}


	/**
	* @param int $rsstype
	* @return void
	*/
	public function setRsstype($rsstype){
		$this->rsstype=$rsstype;
	}


	/**
	* @param int $rssarticles
	* @return void
	*/
	public function setRssarticles($rssarticles){
		$this->rssarticles=$rssarticles;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param int $warnafter
	* @return void
	*/
	public function setWarnafter($warnafter){
		$this->warnafter=$warnafter;
	}


	/**
	* @param int $blockafter
	* @return void
	*/
	public function setBlockafter($blockafter){
		$this->blockafter=$blockafter;
	}


	/**
	* @param int $blockperiod
	* @return void
	*/
	public function setBlockperiod($blockperiod){
		$this->blockperiod=$blockperiod;
	}

}

?>
