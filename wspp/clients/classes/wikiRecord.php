<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class wikiRecord {
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $disablecamelcase;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $ewikiacceptbinary;
	/** 
	* @var int
	*/
	public $ewikiprinttitle;
	/** 
	* @var int
	*/
	public $htmlmode;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $initialcontent;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $pagename;
	/** 
	* @var int
	*/
	public $removepages;
	/** 
	* @var int
	*/
	public $revertchanges;
	/** 
	* @var int
	*/
	public $setpageflags;
	/** 
	* @var int
	*/
	public $strippages;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var string
	*/
	public $wtype;

	/**
	* default constructor for class wikiRecord
	* @param int $course
	* @param int $disablecamelcase
	* @param string $error
	* @param int $ewikiacceptbinary
	* @param int $ewikiprinttitle
	* @param int $htmlmode
	* @param int $id
	* @param string $initialcontent
	* @param string $name
	* @param string $pagename
	* @param int $removepages
	* @param int $revertchanges
	* @param int $setpageflags
	* @param int $strippages
	* @param string $summary
	* @param int $timemodified
	* @param string $wtype
	* @return wikiRecord
	*/
	 public function wikiRecord($course=0,$disablecamelcase=0,$error='',$ewikiacceptbinary=0,$ewikiprinttitle=0,$htmlmode=0,$id=0,$initialcontent='',$name='',$pagename='',$removepages=0,$revertchanges=0,$setpageflags=0,$strippages=0,$summary='',$timemodified=0,$wtype=''){
		 $this->course=$course   ;
		 $this->disablecamelcase=$disablecamelcase   ;
		 $this->error=$error   ;
		 $this->ewikiacceptbinary=$ewikiacceptbinary   ;
		 $this->ewikiprinttitle=$ewikiprinttitle   ;
		 $this->htmlmode=$htmlmode   ;
		 $this->id=$id   ;
		 $this->initialcontent=$initialcontent   ;
		 $this->name=$name   ;
		 $this->pagename=$pagename   ;
		 $this->removepages=$removepages   ;
		 $this->revertchanges=$revertchanges   ;
		 $this->setpageflags=$setpageflags   ;
		 $this->strippages=$strippages   ;
		 $this->summary=$summary   ;
		 $this->timemodified=$timemodified   ;
		 $this->wtype=$wtype   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return int
	*/
	public function getDisablecamelcase(){
		 return $this->disablecamelcase;
	}


	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return int
	*/
	public function getEwikiacceptbinary(){
		 return $this->ewikiacceptbinary;
	}


	/**
	* @return int
	*/
	public function getEwikiprinttitle(){
		 return $this->ewikiprinttitle;
	}


	/**
	* @return int
	*/
	public function getHtmlmode(){
		 return $this->htmlmode;
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
	public function getInitialcontent(){
		 return $this->initialcontent;
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
	public function getPagename(){
		 return $this->pagename;
	}


	/**
	* @return int
	*/
	public function getRemovepages(){
		 return $this->removepages;
	}


	/**
	* @return int
	*/
	public function getRevertchanges(){
		 return $this->revertchanges;
	}


	/**
	* @return int
	*/
	public function getSetpageflags(){
		 return $this->setpageflags;
	}


	/**
	* @return int
	*/
	public function getStrippages(){
		 return $this->strippages;
	}


	/**
	* @return string
	*/
	public function getSummary(){
		 return $this->summary;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return string
	*/
	public function getWtype(){
		 return $this->wtype;
	}

	/*set accessors */

	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param int $disablecamelcase
	* @return void
	*/
	public function setDisablecamelcase($disablecamelcase){
		$this->disablecamelcase=$disablecamelcase;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $ewikiacceptbinary
	* @return void
	*/
	public function setEwikiacceptbinary($ewikiacceptbinary){
		$this->ewikiacceptbinary=$ewikiacceptbinary;
	}


	/**
	* @param int $ewikiprinttitle
	* @return void
	*/
	public function setEwikiprinttitle($ewikiprinttitle){
		$this->ewikiprinttitle=$ewikiprinttitle;
	}


	/**
	* @param int $htmlmode
	* @return void
	*/
	public function setHtmlmode($htmlmode){
		$this->htmlmode=$htmlmode;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param string $initialcontent
	* @return void
	*/
	public function setInitialcontent($initialcontent){
		$this->initialcontent=$initialcontent;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $pagename
	* @return void
	*/
	public function setPagename($pagename){
		$this->pagename=$pagename;
	}


	/**
	* @param int $removepages
	* @return void
	*/
	public function setRemovepages($removepages){
		$this->removepages=$removepages;
	}


	/**
	* @param int $revertchanges
	* @return void
	*/
	public function setRevertchanges($revertchanges){
		$this->revertchanges=$revertchanges;
	}


	/**
	* @param int $setpageflags
	* @return void
	*/
	public function setSetpageflags($setpageflags){
		$this->setpageflags=$setpageflags;
	}


	/**
	* @param int $strippages
	* @return void
	*/
	public function setStrippages($strippages){
		$this->strippages=$strippages;
	}


	/**
	* @param string $summary
	* @return void
	*/
	public function setSummary($summary){
		$this->summary=$summary;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param string $wtype
	* @return void
	*/
	public function setWtype($wtype){
		$this->wtype=$wtype;
	}

}

?>
