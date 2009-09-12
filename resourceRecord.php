<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class resourceRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $name;
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
	public $reference;
	/** 
	* @var  string
	*/
	public $summary;
	/** 
	* @var  string
	*/
	public $alltext;
	/** 
	* @var  string
	*/
	public $popup;
	/** 
	* @var  string
	*/
	public $options;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $section;
	/** 
	* @var  integer
	*/
	public $visible;
	/** 
	* @var  integer
	*/
	public $groupmode;
	/** 
	* @var  integer
	*/
	public $coursemodule;
	/** 
	* @var  string
	*/
	public $url;
	/** 
	* @var  string
	*/
	public $timemodified_ut;
	 public function resourceRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->name='';
		 $this->course=0;
		 $this->type='';
		 $this->reference='';
		 $this->summary='';
		 $this->alltext='';
		 $this->popup='';
		 $this->options='';
		 $this->timemodified=0;
		 $this->section=0;
		 $this->visible=0;
		 $this->groupmode=0;
		 $this->coursemodule=0;
		 $this->url='';
		 $this->timemodified_ut='';
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getName(){
		 return $this->name;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getType(){
		 return $this->type;
	}

	public function getReference(){
		 return $this->reference;
	}

	public function getSummary(){
		 return $this->summary;
	}

	public function getAlltext(){
		 return $this->alltext;
	}

	public function getPopup(){
		 return $this->popup;
	}

	public function getOptions(){
		 return $this->options;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	public function getSection(){
		 return $this->section;
	}

	public function getVisible(){
		 return $this->visible;
	}

	public function getGroupmode(){
		 return $this->groupmode;
	}

	public function getCoursemodule(){
		 return $this->coursemodule;
	}

	public function getUrl(){
		 return $this->url;
	}

	public function getTimemodified_ut(){
		 return $this->timemodified_ut;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setType($type){
		$this->type=$type;
	}

	public function setReference($reference){
		$this->reference=$reference;
	}

	public function setSummary($summary){
		$this->summary=$summary;
	}

	public function setAlltext($alltext){
		$this->alltext=$alltext;
	}

	public function setPopup($popup){
		$this->popup=$popup;
	}

	public function setOptions($options){
		$this->options=$options;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

	public function setSection($section){
		$this->section=$section;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

	public function setGroupmode($groupmode){
		$this->groupmode=$groupmode;
	}

	public function setCoursemodule($coursemodule){
		$this->coursemodule=$coursemodule;
	}

	public function setUrl($url){
		$this->url=$url;
	}

	public function setTimemodified_ut($timemodified_ut){
		$this->timemodified_ut=$timemodified_ut;
	}

}

?>
