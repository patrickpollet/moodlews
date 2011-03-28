<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class wikiRecord {
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
	public $summary;
	/** 
	* @var string
	*/
	public $wtype;
	/** 
	* @var int
	*/
	public $ewikiacceptbinary;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $pagename;
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
	public $disablecamelcase;
	/** 
	* @var int
	*/
	public $setpageflags;
	/** 
	* @var int
	*/
	public $strippages;
	/** 
	* @var int
	*/
	public $removepages;
	/** 
	* @var int
	*/
	public $revertchanges;
	/** 
	* @var string
	*/
	public $initialcontent;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class wikiRecord
	* @param string $error
	* @param int $id
	* @param string $name
	* @param string $summary
	* @param string $wtype
	* @param int $ewikiacceptbinary
	* @param int $course
	* @param string $pagename
	* @param int $ewikiprinttitle
	* @param int $htmlmode
	* @param int $disablecamelcase
	* @param int $setpageflags
	* @param int $strippages
	* @param int $removepages
	* @param int $revertchanges
	* @param string $initialcontent
	* @param int $timemodified
	* @return wikiRecord
	*/
	 public function wikiRecord($error='',$id=0,$name='',$summary='',$wtype='',$ewikiacceptbinary=0,$course=0,$pagename='',$ewikiprinttitle=0,$htmlmode=0,$disablecamelcase=0,$setpageflags=0,$strippages=0,$removepages=0,$revertchanges=0,$initialcontent='',$timemodified=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->summary=$summary   ;
		 $this->wtype=$wtype   ;
		 $this->ewikiacceptbinary=$ewikiacceptbinary   ;
		 $this->course=$course   ;
		 $this->pagename=$pagename   ;
		 $this->ewikiprinttitle=$ewikiprinttitle   ;
		 $this->htmlmode=$htmlmode   ;
		 $this->disablecamelcase=$disablecamelcase   ;
		 $this->setpageflags=$setpageflags   ;
		 $this->strippages=$strippages   ;
		 $this->removepages=$removepages   ;
		 $this->revertchanges=$revertchanges   ;
		 $this->initialcontent=$initialcontent   ;
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
	public function getSummary(){
		 return $this->summary;
	}


	/**
	* @return string
	*/
	public function getWtype(){
		 return $this->wtype;
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
	public function getCourse(){
		 return $this->course;
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
	public function getDisablecamelcase(){
		 return $this->disablecamelcase;
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
	* @return string
	*/
	public function getInitialcontent(){
		 return $this->initialcontent;
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
	* @param string $summary
	* @return void
	*/
	public function setSummary($summary){
		$this->summary=$summary;
	}


	/**
	* @param string $wtype
	* @return void
	*/
	public function setWtype($wtype){
		$this->wtype=$wtype;
	}


	/**
	* @param int $ewikiacceptbinary
	* @return void
	*/
	public function setEwikiacceptbinary($ewikiacceptbinary){
		$this->ewikiacceptbinary=$ewikiacceptbinary;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $pagename
	* @return void
	*/
	public function setPagename($pagename){
		$this->pagename=$pagename;
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
	* @param int $disablecamelcase
	* @return void
	*/
	public function setDisablecamelcase($disablecamelcase){
		$this->disablecamelcase=$disablecamelcase;
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
	* @param string $initialcontent
	* @return void
	*/
	public function setInitialcontent($initialcontent){
		$this->initialcontent=$initialcontent;
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
