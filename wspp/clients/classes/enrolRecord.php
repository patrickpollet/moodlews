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
	public $course;
	/** 
	* @var string
	*/
	public $enrol;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $timeaccess;
	/** 
	* @var int
	*/
	public $timeend;
	/** 
	* @var int
	*/
	public $timestart;
	/** 
	* @var string
	*/
	public $userid;

	/**
	* default constructor for class enrolRecord
	* @param string $course
	* @param string $enrol
	* @param string $error
	* @param int $timeaccess
	* @param int $timeend
	* @param int $timestart
	* @param string $userid
	* @return enrolRecord
	*/
	 public function enrolRecord($course='',$enrol='',$error='',$timeaccess=0,$timeend=0,$timestart=0,$userid=''){
		 $this->course=$course   ;
		 $this->enrol=$enrol   ;
		 $this->error=$error   ;
		 $this->timeaccess=$timeaccess   ;
		 $this->timeend=$timeend   ;
		 $this->timestart=$timestart   ;
		 $this->userid=$userid   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return string
	*/
	public function getEnrol(){
		 return $this->enrol;
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
	public function getTimeaccess(){
		 return $this->timeaccess;
	}


	/**
	* @return int
	*/
	public function getTimeend(){
		 return $this->timeend;
	}


	/**
	* @return int
	*/
	public function getTimestart(){
		 return $this->timestart;
	}


	/**
	* @return string
	*/
	public function getUserid(){
		 return $this->userid;
	}

	/*set accessors */

	/**
	* @param string $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $enrol
	* @return void
	*/
	public function setEnrol($enrol){
		$this->enrol=$enrol;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $timeaccess
	* @return void
	*/
	public function setTimeaccess($timeaccess){
		$this->timeaccess=$timeaccess;
	}


	/**
	* @param int $timeend
	* @return void
	*/
	public function setTimeend($timeend){
		$this->timeend=$timeend;
	}


	/**
	* @param int $timestart
	* @return void
	*/
	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}


	/**
	* @param string $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}

}

?>
