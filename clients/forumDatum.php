<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumDatum {
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  string
	*/
	public $type;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $intro;
	/** 
	* @var  integer
	*/
	public $assessed;
	/** 
	* @var  integer
	*/
	public $assesstimestart;
	/** 
	* @var  integer
	*/
	public $assesstimefinish;
	/** 
	* @var  integer
	*/
	public $scale;
	/** 
	* @var  integer
	*/
	public $maxbytes;
	/** 
	* @var  integer
	*/
	public $forcesubscribe;
	/** 
	* @var  integer
	*/
	public $trackingtype;
	/** 
	* @var  integer
	*/
	public $rsstype;
	/** 
	* @var  integer
	*/
	public $rssarticles;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $warnafter;
	/** 
	* @var  integer
	*/
	public $blockafter;
	/** 
	* @var  integer
	*/
	public $blockperiod;
	/* full constructor */
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
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getType(){
		 return $this->type;
	}

	public function getName(){
		 return $this->name;
	}

	public function getIntro(){
		 return $this->intro;
	}

	public function getAssessed(){
		 return $this->assessed;
	}

	public function getAssesstimestart(){
		 return $this->assesstimestart;
	}

	public function getAssesstimefinish(){
		 return $this->assesstimefinish;
	}

	public function getScale(){
		 return $this->scale;
	}

	public function getMaxbytes(){
		 return $this->maxbytes;
	}

	public function getForcesubscribe(){
		 return $this->forcesubscribe;
	}

	public function getTrackingtype(){
		 return $this->trackingtype;
	}

	public function getRsstype(){
		 return $this->rsstype;
	}

	public function getRssarticles(){
		 return $this->rssarticles;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	public function getWarnafter(){
		 return $this->warnafter;
	}

	public function getBlockafter(){
		 return $this->blockafter;
	}

	public function getBlockperiod(){
		 return $this->blockperiod;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setType($type){
		$this->type=$type;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setIntro($intro){
		$this->intro=$intro;
	}

	public function setAssessed($assessed){
		$this->assessed=$assessed;
	}

	public function setAssesstimestart($assesstimestart){
		$this->assesstimestart=$assesstimestart;
	}

	public function setAssesstimefinish($assesstimefinish){
		$this->assesstimefinish=$assesstimefinish;
	}

	public function setScale($scale){
		$this->scale=$scale;
	}

	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}

	public function setForcesubscribe($forcesubscribe){
		$this->forcesubscribe=$forcesubscribe;
	}

	public function setTrackingtype($trackingtype){
		$this->trackingtype=$trackingtype;
	}

	public function setRsstype($rsstype){
		$this->rsstype=$rsstype;
	}

	public function setRssarticles($rssarticles){
		$this->rssarticles=$rssarticles;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

	public function setWarnafter($warnafter){
		$this->warnafter=$warnafter;
	}

	public function setBlockafter($blockafter){
		$this->blockafter=$blockafter;
	}

	public function setBlockperiod($blockperiod){
		$this->blockperiod=$blockperiod;
	}

}

?>
