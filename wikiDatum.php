<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class wikiDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var string
	*/
	public $wtype;
	/** 
	* @var integer
	*/
	public $ewikiacceptbinary;
	/** 
	* @var integer
	*/
	public $course;
	/** 
	* @var string
	*/
	public $pagename;
	/** 
	* @var integer
	*/
	public $ewikiprinttitle;
	/** 
	* @var integer
	*/
	public $htmlmode;
	/** 
	* @var integer
	*/
	public $disablecamelcase;
	/** 
	* @var integer
	*/
	public $setpageflags;
	/** 
	* @var integer
	*/
	public $strippages;
	/** 
	* @var integer
	*/
	public $removepages;
	/** 
	* @var integer
	*/
	public $revertchanges;
	/** 
	* @var string
	*/
	public $initialcontent;
	/** 
	* @var integer
	*/
	public $timemodified;
	 public function wikiDatum() {
		 $this->action='';
		 $this->id=0;
		 $this->name='';
		 $this->summary='';
		 $this->wtype='';
		 $this->ewikiacceptbinary=0;
		 $this->course=0;
		 $this->pagename='';
		 $this->ewikiprinttitle=0;
		 $this->htmlmode=0;
		 $this->disablecamelcase=0;
		 $this->setpageflags=0;
		 $this->strippages=0;
		 $this->removepages=0;
		 $this->revertchanges=0;
		 $this->initialcontent='';
		 $this->timemodified=0;
	}
	/* get accessors */
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getName(){
		 return $this->name;
	}

	public function getSummary(){
		 return $this->summary;
	}

	public function getWtype(){
		 return $this->wtype;
	}

	public function getEwikiacceptbinary(){
		 return $this->ewikiacceptbinary;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getPagename(){
		 return $this->pagename;
	}

	public function getEwikiprinttitle(){
		 return $this->ewikiprinttitle;
	}

	public function getHtmlmode(){
		 return $this->htmlmode;
	}

	public function getDisablecamelcase(){
		 return $this->disablecamelcase;
	}

	public function getSetpageflags(){
		 return $this->setpageflags;
	}

	public function getStrippages(){
		 return $this->strippages;
	}

	public function getRemovepages(){
		 return $this->removepages;
	}

	public function getRevertchanges(){
		 return $this->revertchanges;
	}

	public function getInitialcontent(){
		 return $this->initialcontent;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */
	public function setAction($action){
		$this->action=$action;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setSummary($summary){
		$this->summary=$summary;
	}

	public function setWtype($wtype){
		$this->wtype=$wtype;
	}

	public function setEwikiacceptbinary($ewikiacceptbinary){
		$this->ewikiacceptbinary=$ewikiacceptbinary;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setPagename($pagename){
		$this->pagename=$pagename;
	}

	public function setEwikiprinttitle($ewikiprinttitle){
		$this->ewikiprinttitle=$ewikiprinttitle;
	}

	public function setHtmlmode($htmlmode){
		$this->htmlmode=$htmlmode;
	}

	public function setDisablecamelcase($disablecamelcase){
		$this->disablecamelcase=$disablecamelcase;
	}

	public function setSetpageflags($setpageflags){
		$this->setpageflags=$setpageflags;
	}

	public function setStrippages($strippages){
		$this->strippages=$strippages;
	}

	public function setRemovepages($removepages){
		$this->removepages=$removepages;
	}

	public function setRevertchanges($revertchanges){
		$this->revertchanges=$revertchanges;
	}

	public function setInitialcontent($initialcontent){
		$this->initialcontent=$initialcontent;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
