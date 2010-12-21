<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class resourceRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
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
	public $reference;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var string
	*/
	public $alltext;
	/** 
	* @var string
	*/
	public $popup;
	/** 
	* @var string
	*/
	public $options;
	/** 
	* @var integer
	*/
	public $timemodified;
	/** 
	* @var integer
	*/
	public $section;
	/** 
	* @var integer
	*/
	public $visible;
	/** 
	* @var integer
	*/
	public $groupmode;
	/** 
	* @var integer
	*/
	public $coursemodule;
	/** 
	* @var string
	*/
	public $url;
	/** 
	* @var string
	*/
	public $timemodified_ut;

	/**
	* default constructor for class resourceRecord
	* @param string $error
	* @param integer $id
	* @param string $name
	* @param integer $course
	* @param string $type
	* @param string $reference
	* @param string $summary
	* @param string $alltext
	* @param string $popup
	* @param string $options
	* @param integer $timemodified
	* @param integer $section
	* @param integer $visible
	* @param integer $groupmode
	* @param integer $coursemodule
	* @param string $url
	* @param string $timemodified_ut
	* @return resourceRecord
	*/
	 public function resourceRecord($error='',$id=0,$name='',$course=0,$type='',$reference='',$summary='',$alltext='',$popup='',$options='',$timemodified=0,$section=0,$visible=0,$groupmode=0,$coursemodule=0,$url='',$timemodified_ut=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->course=$course   ;
		 $this->type=$type   ;
		 $this->reference=$reference   ;
		 $this->summary=$summary   ;
		 $this->alltext=$alltext   ;
		 $this->popup=$popup   ;
		 $this->options=$options   ;
		 $this->timemodified=$timemodified   ;
		 $this->section=$section   ;
		 $this->visible=$visible   ;
		 $this->groupmode=$groupmode   ;
		 $this->coursemodule=$coursemodule   ;
		 $this->url=$url   ;
		 $this->timemodified_ut=$timemodified_ut   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return integer
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
	public function getReference(){
		 return $this->reference;
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
	public function getAlltext(){
		 return $this->alltext;
	}


	/**
	* @return string
	*/
	public function getPopup(){
		 return $this->popup;
	}


	/**
	* @return string
	*/
	public function getOptions(){
		 return $this->options;
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
	public function getSection(){
		 return $this->section;
	}


	/**
	* @return integer
	*/
	public function getVisible(){
		 return $this->visible;
	}


	/**
	* @return integer
	*/
	public function getGroupmode(){
		 return $this->groupmode;
	}


	/**
	* @return integer
	*/
	public function getCoursemodule(){
		 return $this->coursemodule;
	}


	/**
	* @return string
	*/
	public function getUrl(){
		 return $this->url;
	}


	/**
	* @return string
	*/
	public function getTimemodified_ut(){
		 return $this->timemodified_ut;
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
	* @param integer $id
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
	* @param string $reference
	* @return void
	*/
	public function setReference($reference){
		$this->reference=$reference;
	}


	/**
	* @param string $summary
	* @return void
	*/
	public function setSummary($summary){
		$this->summary=$summary;
	}


	/**
	* @param string $alltext
	* @return void
	*/
	public function setAlltext($alltext){
		$this->alltext=$alltext;
	}


	/**
	* @param string $popup
	* @return void
	*/
	public function setPopup($popup){
		$this->popup=$popup;
	}


	/**
	* @param string $options
	* @return void
	*/
	public function setOptions($options){
		$this->options=$options;
	}


	/**
	* @param integer $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param integer $section
	* @return void
	*/
	public function setSection($section){
		$this->section=$section;
	}


	/**
	* @param integer $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}


	/**
	* @param integer $groupmode
	* @return void
	*/
	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
	}


	/**
	* @param integer $coursemodule
	* @return void
	*/
	public function setCoursemodule($coursemodule){
		$this->coursemodule=$coursemodule;
	}


	/**
	* @param string $url
	* @return void
	*/
	public function setUrl($url){
		$this->url=$url;
	}


	/**
	* @param string $timemodified_ut
	* @return void
	*/
	public function setTimemodified_ut($timemodified_ut){
		$this->timemodified_ut=$timemodified_ut;
	}

}

?>
