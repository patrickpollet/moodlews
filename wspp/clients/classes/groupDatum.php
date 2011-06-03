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
	public $courseid;
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
	public $hidepicture;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var int
	*/
	public $picture;

	/**
	* default constructor for class groupDatum
	* @param string $action
	* @param int $courseid
	* @param string $description
	* @param string $enrolmentkey
	* @param int $hidepicture
	* @param int $id
	* @param string $name
	* @param int $picture
	* @return groupDatum
	*/
	 public function groupDatum($action='',$courseid=0,$description='',$enrolmentkey='',$hidepicture=0,$id=0,$name='',$picture=0){
		 $this->action=$action   ;
		 $this->courseid=$courseid   ;
		 $this->description=$description   ;
		 $this->enrolmentkey=$enrolmentkey   ;
		 $this->hidepicture=$hidepicture   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->picture=$picture   ;
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
	* @return string
	*/
	public function getEnrolmentkey(){
		 return $this->enrolmentkey;
	}


	/**
	* @return int
	*/
	public function getHidepicture(){
		 return $this->hidepicture;
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
	* @return int
	*/
	public function getPicture(){
		 return $this->picture;
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
	* @param string $enrolmentkey
	* @return void
	*/
	public function setEnrolmentkey($enrolmentkey){
		$this->enrolmentkey=$enrolmentkey;
	}


	/**
	* @param int $hidepicture
	* @return void
	*/
	public function setHidepicture($hidepicture){
		$this->hidepicture=$hidepicture;
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
	* @param int $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}

}

?>
