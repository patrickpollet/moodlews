<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupingDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var int
	*/
	public $courseid;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;

	/**
	* default constructor for class groupingDatum
	* @param string $action
	* @param int $courseid
	* @param string $description
	* @param int $id
	* @param string $name
	* @return groupingDatum
	*/
	 public function groupingDatum($action='',$courseid=0,$description='',$id=0,$name=''){
		 $this->action=$action   ;
		 $this->courseid=$courseid   ;
		 $this->description=$description   ;
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
	* @return int
	*/
	public function getCourseid(){
		 return $this->courseid;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
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
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
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
