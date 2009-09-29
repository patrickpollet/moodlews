<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class labelDatum {
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
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $content;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/* full constructor */
	 public function labelDatum($action='',$id=0,$course=0,$name='',$content='',$timemodified=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->name=$name   ;
		 $this->content=$content   ;
		 $this->timemodified=$timemodified   ;
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

	public function getName(){
		 return $this->name;
	}

	public function getContent(){
		 return $this->content;
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

	public function setCourse($course){
		$this->course=$course;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setContent($content){
		$this->content=$content;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
