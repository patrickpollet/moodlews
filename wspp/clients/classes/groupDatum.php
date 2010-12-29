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
	* @var integer
	*/
	public $id;
	/** 
	* @var integer
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
	* @var integer
	*/
	public $picture;
	/** 
	* @var integer
	*/
	public $hidepicture;

	/**
	* default constructor for class groupDatum
	* @param string $action
	* @param integer $id
	* @param integer $courseid
	* @param string $name
	* @param string $description
	* @param string $enrolmentkey
	* @param integer $picture
	* @param integer $hidepicture
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
	* @return integer
	*/
	public function getId(){
		 return $this->id;
	}


	/**
	* @return integer
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
	* @return integer
	*/
	public function getPicture(){
		 return $this->picture;
	}


	/**
	* @return integer
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
	* @param integer $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param integer $courseid
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
	* @param integer $picture
	* @return void
	*/
	public function setPicture($picture){
		$this->picture=$picture;
	}


	/**
	* @param integer $hidepicture
	* @return void
	*/
	public function setHidepicture($hidepicture){
		$this->hidepicture=$hidepicture;
	}

}

?>
