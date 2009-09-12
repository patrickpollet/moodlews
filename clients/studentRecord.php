<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class studentRecord {
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  integer
	*/
	public $timestart;
	/** 
	* @var  integer
	*/
	public $timeend;
	/** 
	* @var  integer
	*/
	public $timeaccess;
	/** 
	* @var  string
	*/
	public $enrol;
	/* full constructor */
	 public function studentRecord($userid=0,$course=0,$timestart=0,$timeend=0,$timeaccess=0,$enrol=''){
		 $this->userid=$userid   ;
		 $this->course=$course   ;
		 $this->timestart=$timestart   ;
		 $this->timeend=$timeend   ;
		 $this->timeaccess=$timeaccess   ;
		 $this->enrol=$enrol   ;
	}
	/* get accessors */
	public function getUserid(){
		 return $this->userid;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getTimestart(){
		 return $this->timestart;
	}

	public function getTimeend(){
		 return $this->timeend;
	}

	public function getTimeaccess(){
		 return $this->timeaccess;
	}

	public function getEnrol(){
		 return $this->enrol;
	}

	/*set accessors */
	public function setUserid($userid){
		$this->userid=$userid;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setTimestart($timestart){
		$this->timestart=$timestart;
	}

	public function setTimeend($timeend){
		$this->timeend=$timeend;
	}

	public function setTimeaccess($timeaccess){
		$this->timeaccess=$timeaccess;
	}

	public function setEnrol($enrol){
		$this->enrol=$enrol;
	}

}

?>
