<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class labelDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var string
	*/
	public $content;
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;

	/**
	* default constructor for class labelDatum
	* @param string $action
	* @param string $content
	* @param int $course
	* @param int $id
	* @param string $name
	* @return labelDatum
	*/
	 public function labelDatum($action='',$content='',$course=0,$id=0,$name=''){
		 $this->action=$action   ;
		 $this->content=$content   ;
		 $this->course=$course   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
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
	public function getCourse(){
		 return $this->course;
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

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param string $content
	* @return void
	*/
	public function setContent($content){
		$this->content=$content;
	}


	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
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

}

?>
