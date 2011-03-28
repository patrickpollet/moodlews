<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupRecord {
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
	* @var int
	*/
	public $picture;
	/** 
	* @var int
	*/
	public $hidepicture;
	/** 
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var string
	*/
	public $enrolmentkey;

	/**
	* default constructor for class groupRecord
	* @param string $error
	* @param int $id
	* @param int $courseid
	* @param string $name
	* @param string $description
	* @param int $picture
	* @param int $hidepicture
	* @param int $timecreated
	* @param int $timemodified
	* @param string $enrolmentkey
	* @return groupRecord
	*/
	 public function groupRecord($error='',$id=0,$courseid=0,$name='',$description='',$picture=0,$hidepicture=0,$timecreated=0,$timemodified=0,$enrolmentkey=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->courseid=$courseid   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->picture=$picture   ;
		 $this->hidepicture=$hidepicture   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
		 $this->enrolmentkey=$enrolmentkey   ;
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


	/**
	* @return int
	*/
	public function getTimecreated(){
		 return $this->timecreated;
	}


	/**
	* @return int
	*/
	public function getTimemodified(){
		 return $this->timemodified;
	}


	/**
	* @return string
	*/
	public function getEnrolmentkey(){
		 return $this->enrolmentkey;
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


	/**
	* @param int $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param string $enrolmentkey
	* @return void
	*/
	public function setEnrolmentkey($enrolmentkey){
		$this->enrolmentkey=$enrolmentkey;
	}

}

?>
