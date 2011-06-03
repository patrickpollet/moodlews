<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupRecord {
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
	* @var string
	*/
	public $error;
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
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class groupRecord
	* @param int $courseid
	* @param string $description
	* @param string $enrolmentkey
	* @param string $error
	* @param int $hidepicture
	* @param int $id
	* @param string $name
	* @param int $picture
	* @param int $timecreated
	* @param int $timemodified
	* @return groupRecord
	*/
	 public function groupRecord($courseid=0,$description='',$enrolmentkey='',$error='',$hidepicture=0,$id=0,$name='',$picture=0,$timecreated=0,$timemodified=0){
		 $this->courseid=$courseid   ;
		 $this->description=$description   ;
		 $this->enrolmentkey=$enrolmentkey   ;
		 $this->error=$error   ;
		 $this->hidepicture=$hidepicture   ;
		 $this->id=$id   ;
		 $this->name=$name   ;
		 $this->picture=$picture   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
	}
	/* get accessors */

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
	* @return string
	*/
	public function getError(){
		 return $this->error;
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

	/*set accessors */

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
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
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

}

?>
