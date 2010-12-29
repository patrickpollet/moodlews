<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class enrolRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var string
	*/
	public $userid;
	/** 
	* @var string
	*/
	public $course;
	/** 
	* @var integer
	*/
	public $timestart;
	/** 
	* @var integer
	*/
	public $timeend;
	/** 
	* @var integer
	*/
	public $timeaccess;
	/** 
	* @var string
	*/
	public $enrol;

	/**
	* default constructor for class enrolRecord
	* @return enrolRecord
	*/	 public function enrolRecord() {
		 $this->error='';
		 $this->userid='';
		 $this->course='';
		 $this->timestart=0;
		 $this->timeend=0;
		 $this->timeaccess=0;
		 $this->enrol='';
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return string
	*/
	public function getUserid(){
		 return $this->userid;
	}


	/**
	* @return string
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return integer
	*/
	public function getTimestart(){
		 return $this->timestart;
	}


	/**
	* @return integer
	*/
	public function getTimeend(){
		 return $this->timeend;
	}


	/**
	* @return integer
	*/
	public function getTimeaccess(){
		 return $this->timeaccess;
	}


	/**
	* @return string
	*/
	public function getEnrol(){
		 return $this->enrol;
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
	* @param string $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param string $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param integer $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param integer $timeend
	* @return void
	*/
	public function setTimeend($timeend){
		$this->timeend=$timeend;
	}


	/**
	* @param integer $timeaccess
	* @return void
	*/
	public function setTimeaccess($timeaccess){
		$this->timeaccess=$timeaccess;
	}


	/**
	* @param string $enrol
	* @return void
	*/
	public function setEnrol($enrol){
		$this->enrol=$enrol;
	}

}

?>
