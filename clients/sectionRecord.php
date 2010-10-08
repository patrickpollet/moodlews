<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class sectionRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
	*/
	public $course;
	/** 
	* @var integer
	*/
	public $section;
	/** 
	* @var string
	*/
	public $sequence;
	/** 
	* @var string
	*/
	public $summary;
	/** 
	* @var integer
	*/
	public $visible;
	/* full constructor */
	 public function sectionRecord($error='',$id=0,$course=0,$section=0,$sequence='',$summary='',$visible=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->section=$section   ;
		 $this->sequence=$sequence   ;
		 $this->summary=$summary   ;
		 $this->visible=$visible   ;
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

	public function getSection(){
		 return $this->section;
	}

	public function getSequence(){
		 return $this->sequence;
	}

	public function getSummary(){
		 return $this->summary;
	}

	public function getVisible(){
		 return $this->visible;
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

	public function setSection($section){
		$this->section=$section;
	}

	public function setSequence($sequence){
		$this->sequence=$sequence;
	}

	public function setSummary($summary){
		$this->summary=$summary;
	}

	public function setVisible($visible){
		$this->visible=$visible;
	}

}

?>
