<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class sectionDatum {
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
	* @var  integer
	*/
	public $section;
	/** 
	* @var  string
	*/
	public $summary;
	/** 
	* @var  string
	*/
	public $sequence;
	/** 
	* @var  integer
	*/
	public $visible;
	/* full constructor */
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
	public function getAction(){
		 return $this->action;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getSection(){
		 return $this->section;
	}

	public function getSummary(){
		 return $this->summary;
	}

	public function getSequence(){
		 return $this->sequence;
	}

	public function getVisible(){
		 return $this->visible;
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

	public function setSection($section){
		$this->section=$section;
	}

	public function setSummary($summary){
		$this->summary=$summary;
	}

	public function setSequence($sequence){
		$this->sequence=$sequence;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
