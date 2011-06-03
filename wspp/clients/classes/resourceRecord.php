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
	public $alltext;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $coursemodule;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $groupingid;
	/** 
	* @var int
	*/
	public $groupmembersonly;
	/** 
	* @var int
	*/
	public $groupmode;
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
	public $options;
	/** 
	* @var string
	*/
	public $popup;
	/** 
	* @var string
	*/
	public $reference;
	/** 
	* @var int
	*/
	public $section;
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
	public $timemodified_ut;
	/** 
	* @var string
	*/
	public $type;
	/** 
	* @var string
	*/
	public $url;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class resourceRecord
	* @param string $alltext
	* @param int $course
	* @param int $coursemodule
	* @param string $error
	* @param int $groupingid
	* @param int $groupmembersonly
	* @param int $groupmode
	* @param int $id
	* @param string $name
	* @param string $options
	* @param string $popup
	* @param string $reference
	* @param int $section
	* @param string $summary
	* @param int $timemodified
	* @param string $timemodified_ut
	* @param string $type
	* @param string $url
	* @param int $visible
	* @return resourceRecord
	*/
	 public function resourceRecord($alltext='',$course=0,$coursemodule=0,$error='',$groupingid=0,$groupmembersonly=0,$groupmode=0,$id=0,$name='',$options='',$popup='',$reference='',$section=0,$summary='',$timemodified=0,$timemodified_ut='',$type='',$url='',$visible=0){
		 $this->alltext=$alltext   ;
		 $this->course=$course   ;
		 $this->coursemodule=$coursemodule   ;
		 $this->error=$error   ;
		 $this->groupingid=$groupingid   ;
		 $this->groupmembersonly=$groupmembersonly   ;
		 $this->groupmode=$groupmode   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->options=$options   ;
		 $this->popup=$popup   ;
		 $this->reference=$reference   ;
		 $this->section=$section   ;
		 $this->summary=$summary   ;
		 $this->timemodified=$timemodified   ;
		 $this->timemodified_ut=$timemodified_ut   ;
		 $this->type=$type   ;
		 $this->url=$url   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAlltext(){
		 return $this->alltext;
	}


	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return int
	*/
	public function getCoursemodule(){
		 return $this->coursemodule;
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
	public function getGroupingid(){
		 return $this->groupingid;
	}


	/**
	* @return int
	*/
	public function getGroupmembersonly(){
		 return $this->groupmembersonly;
	}


	/**
	* @return int
	*/
	public function getGroupmode(){
		 return $this->groupmode;
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
	public function getOptions(){
		 return $this->options;
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
	public function getReference(){
		 return $this->reference;
	}


	/**
	* @return int
	*/
	public function getSection(){
		 return $this->section;
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
	public function getTimemodified_ut(){
		 return $this->timemodified_ut;
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
	public function getUrl(){
		 return $this->url;
	}


	/**
	* @return int
	*/
	public function getVisible(){
		 return $this->visible;
	}

	/*set accessors */

	/**
	* @param string $alltext
	* @return void
	*/
	public function setAlltext($alltext){
		$this->alltext=$alltext;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param int $coursemodule
	* @return void
	*/
	public function setCoursemodule($coursemodule){
		$this->coursemodule=$coursemodule;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $groupingid
	* @return void
	*/
	public function setGroupingid($groupingid){
		$this->groupingid=$groupingid;
	}


	/**
	* @param int $groupmembersonly
	* @return void
	*/
	public function setGroupmembersonly($groupmembersonly){
		$this->groupmembersonly=$groupmembersonly;
	}


	/**
	* @param int $groupmode
	* @return void
	*/
	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
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
	* @param string $options
	* @return void
	*/
	public function setOptions($options){
		$this->options=$options;
	}


	/**
	* @param string $popup
	* @return void
	*/
	public function setPopup($popup){
		$this->popup=$popup;
	}


	/**
	* @param string $reference
	* @return void
	*/
	public function setReference($reference){
		$this->reference=$reference;
	}


	/**
	* @param int $section
	* @return void
	*/
	public function setSection($section){
		$this->section=$section;
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
	* @param string $timemodified_ut
	* @return void
	*/
	public function setTimemodified_ut($timemodified_ut){
		$this->timemodified_ut=$timemodified_ut;
	}


	/**
	* @param string $type
	* @return void
	*/
	public function setType($type){
		$this->type=$type;
	}


	/**
	* @param string $url
	* @return void
	*/
	public function setUrl($url){
		$this->url=$url;
	}


	/**
	* @param int $visible
	* @return void
	*/
	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
