<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class labelRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $content;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class labelRecord
	* @param string $error
	* @param int $id
	* @param int $course
	* @param string $name
	* @param string $content
	* @param int $timemodified
	* @return labelRecord
	*/
	 public function labelRecord($error='',$id=0,$course=0,$name='',$content='',$timemodified=0){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->name=$name   ;
		 $this->content=$content   ;
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
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
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
	public function getContent(){
		 return $this->content;
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
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $content
	* @return void
	*/
	public function setContent($content){
		$this->content=$content;
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
