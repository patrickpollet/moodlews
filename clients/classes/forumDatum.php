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
	* @param string $action
	* @param integer $id
	* @param integer $course
	* @param string $type
	* @param string $name
	* @param string $intro
	* @param integer $assessed
	* @param integer $assesstimestart
	* @param integer $assesstimefinish
	* @param integer $scale
	* @param integer $maxbytes
	* @param integer $forcesubscribe
	* @param integer $trackingtype
	* @param integer $rsstype
	* @param integer $rssarticles
	* @param integer $timemodified
	* @param integer $warnafter
	* @param integer $blockafter
	* @param integer $blockperiod
	* @return forumDatum
	*/
	 public function forumDatum($action='',$id=0,$course=0,$type='',$name='',$intro='',$assessed=0,$assesstimestart=0,$assesstimefinish=0,$scale=0,$maxbytes=0,$forcesubscribe=0,$trackingtype=0,$rsstype=0,$rssarticles=0,$timemodified=0,$warnafter=0,$blockafter=0,$blockperiod=0){
		 $this->action=$action   ;
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
