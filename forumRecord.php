<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumRecord {
	/** 
	* @var  string
	*/
	public $error;
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
	 public function forumRecord() {
		 $this->error='';
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
	public function getError(){
		 return $this->error;
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
	public function setError($error){
		$this->error=$error;
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
