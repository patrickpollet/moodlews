<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupDatum {
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
	public $courseid;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var string
	*/
	public $enrolmentkey;
	/** 
	* @var int
	*/
	public $picture;
	/** 
	* @var int
	*/
	public $hidepicture;

	/**
	* default constructor for class groupDatum
	* @param string $action
	* @param int $id
	* @param int $courseid
	* @param string $name
	* @param string $description
	* @param string $enrolmentkey
	* @param int $picture
	* @param int $hidepicture
	* @return groupDatum
	*/
	 public function groupDatum($action='',$id=0,$courseid=0,$name='',$description='',$enrolmentkey='',$picture=0,$hidepicture=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->enrolmentkey=$enrolmentkey   ;
		 $this->picture=$picture   ;
		 $this->hidepicture=$hidepicture   ;
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
	public function getCourseid(){
		 return $this->courseid;
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
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return string
	*/
	public function getEnrolmentkey(){
		 return $this->enrolmentkey;
	}


	/**
	* @return int
	*/
	public function getPicture(){
		 return $this->picture;
	}


	/**
	* @return int
	*/
	public function getHidepicture(){
		 return $this->hidepicture;
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
	* @param int $courseid
	* @return void
	*/
	public function setCourseid($courseid){
		$this->courseid=$courseid;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param string $enrolmentkey
	* @return void
	*/
	public function setEnrolmentkey($enrolmentkey){
		$this->enrolmentkey=$enrolmentkey;
	}


	/**
	* @param int $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}


	/**
	* @param int $hidepicture
	* @return void
	*/
	public function setHidepicture($hidepicture){
		$this->hidepicture=$hidepicture;
	}

}

?>
