<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class sectionDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $section;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var string
	*/
	public $sequence;
	/** 
	* @var int
	*/
	public $visible;

	/**
	* default constructor for class sectionDatum
	* @param string $action
	* @param int $id
	* @param int $course
	* @param int $section
	* @param string $summary
	* @param string $sequence
	* @param int $visible
	* @return sectionDatum
	*/
	 public function sectionDatum($action='',$id=0,$course=0,$section=0,$summary='',$sequence='',$visible=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->section=$section   ;
		 $this->summary=$summary   ;
		 $this->sequence=$sequence   ;
		 $this->visible=$visible   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
	}


	/**
	* @return int
	*/
	public function getId(){
		 return $this->id;
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
	* @return string
	*/
	public function getSequence(){
		 return $this->sequence;
	}


	/**
	* @return int
	*/
	public function getVisible(){
		 return $this->visible;
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
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
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
	* @param string $sequence
	* @return void
	*/
	public function setSequence($sequence){
		$this->sequence=$sequence;
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
