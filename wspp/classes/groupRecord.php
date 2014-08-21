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
	public $idnumber;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var integer
	*/
	public $picture;
	/** 
	* @var integer
	*/
	public $hidepicture;
	/** 
	* @var integer
	*/
	public $timecreated;
	/** 
	* @var integer
	*/
	public $timemodified;
	/** 
	* @var string
	*/
	public $enrolmentkey;

	/**
	* default constructor for class groupRecord
	* @return groupRecord
	*/	 public function groupRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->courseid=0;
		 $this->name='';
		 $this->idnumber='';
		 $this->description='';
		 $this->picture=0;
		 $this->hidepicture=0;
		 $this->timecreated=0;
		 $this->timemodified=0;
		 $this->enrolmentkey='';
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
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
	public function getIdnumber(){
		 return $this->idnumber;
	}


	/**
	* @return string
	*/
	public function getDescription(){
		 return $this->description;
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


	/**
	* @return integer
	*/
	public function getTimecreated(){
		 return $this->timecreated;
	}


	/**
	* @return integer
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
	* @param string $idnumber
	* @return void
	*/
	public function setIdnumber($idnumber){
		$this->idnumber=$idnumber;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
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


	/**
	* @param integer $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}


	/**
	* @param integer $timemodified
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
