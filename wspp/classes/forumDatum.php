<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
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
	* @var integer
	*/
	public $assessed;
	/** 
	* @var integer
	*/
	public $assesstimestart;
	/** 
	* @var integer
	*/
	public $assesstimefinish;
	/** 
	* @var integer
	*/
	public $scale;
	/** 
	* @var integer
	*/
	public $maxbytes;
	/** 
	* @var integer
	*/
	public $forcesubscribe;
	/** 
	* @var integer
	*/
	public $trackingtype;
	/** 
	* @var integer
	*/
	public $rsstype;
	/** 
	* @var integer
	*/
	public $rssarticles;
	/** 
	* @var integer
	*/
	public $timemodified;
	/** 
	* @var integer
	*/
	public $warnafter;
	/** 
	* @var integer
	*/
	public $blockafter;
	/** 
	* @var integer
	*/
	public $blockperiod;

	/**
	* default constructor for class forumDatum
	* @return forumDatum
	*/	 public function forumDatum() {
		 $this->action='';
		 $this->id=0;
		 $this->course=0;
		 $this->type='';
		 $this->name='';
		 $this->intro='';
		 $this->assessed=0;
		 $this->assesstimestart=0;
		 $this->assesstimefinish=0;
		 $this->scale=0;
		 $this->maxbytes=0;
		 $this->forcesubscribe=0;
		 $this->trackingtype=0;
		 $this->rsstype=0;
		 $this->rssarticles=0;
		 $this->timemodified=0;
		 $this->warnafter=0;
		 $this->blockafter=0;
		 $this->blockperiod=0;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return integer
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return integer
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
	* @return integer
	*/
	public function getAssessed(){
		 return $this->assessed;
	}


	/**
	* @return integer
	*/
	public function getAssesstimestart(){
		 return $this->assesstimestart;
	}


	/**
	* @return integer
	*/
	public function getAssesstimefinish(){
		 return $this->assesstimefinish;
	}


	/**
	* @return integer
	*/
	public function getScale(){
		 return $this->scale;
	}


	/**
	* @return integer
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
	}


	/**
	* @return integer
	*/
	public function getForcesubscribe(){
		 return $this->forcesubscribe;
	}


	/**
	* @return integer
	*/
	public function getTrackingtype(){
		 return $this->trackingtype;
	}


	/**
	* @return integer
	*/
	public function getRsstype(){
		 return $this->rsstype;
	}


	/**
	* @return integer
	*/
	public function getRssarticles(){
		 return $this->rssarticles;
	}


	/**
	* @return integer
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return integer
	*/
	public function getWarnafter(){
		 return $this->warnafter;
	}


	/**
	* @return integer
	*/
	public function getBlockafter(){
		 return $this->blockafter;
	}


	/**
	* @return integer
	*/
	public function getBlockperiod(){
		 return $this->blockperiod;
	}

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param integer $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param integer $course
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
	* @param integer $assessed
	* @return void
	*/
	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}


	/**
	* @param integer $assesstimestart
	* @return void
	*/
	public function setAssesstimestart($assesstimestart){
		$this->assesstimestart=$assesstimestart;
	}


	/**
	* @param integer $assesstimefinish
	* @return void
	*/
	public function setAssesstimefinish($assesstimefinish){
		$this->assesstimefinish=$assesstimefinish;
	}


	/**
	* @param integer $scale
	* @return void
	*/
	public function setScale($scale){
		$this->scale=$scale;
	}


	/**
	* @param integer $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param integer $forcesubscribe
	* @return void
	*/
	public function setForcesubscribe($forcesubscribe){
		$this->forcesubscribe=$forcesubscribe;
	}


	/**
	* @param integer $trackingtype
	* @return void
	*/
	public function setTrackingtype($trackingtype){
		$this->trackingtype=$trackingtype;
	}


	/**
	* @param integer $rsstype
	* @return void
	*/
	public function setRsstype($rsstype){
		$this->rsstype=$rsstype;
	}


	/**
	* @param integer $rssarticles
	* @return void
	*/
	public function setRssarticles($rssarticles){
		$this->rssarticles=$rssarticles;
	}


	/**
	* @param integer $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param integer $warnafter
	* @return void
	*/
	public function setWarnafter($warnafter){
		$this->warnafter=$warnafter;
	}


	/**
	* @param integer $blockafter
	* @return void
	*/
	public function setBlockafter($blockafter){
		$this->blockafter=$blockafter;
	}


	/**
	* @param integer $blockperiod
	* @return void
	*/
	public function setBlockperiod($blockperiod){
		$this->blockperiod=$blockperiod;
	}

}

?>
