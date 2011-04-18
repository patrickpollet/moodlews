<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class gradeItemRecord {
	/** 
	* @var int
	*/
	public $dategraded;
	/** 
	* @var int
	*/
	public $datesubmitted;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $feedback_format;
	/** 
	* @var float
	*/
	public $grade;
	/** 
	* @var string
	*/
	public $str_feedback;
	/** 
	* @var string
	*/
	public $str_grade;
	/** 
	* @var string
	*/
	public $str_long_grade;
	/** 
	* @var string
	*/
	public $userid;
	/** 
	* @var string
	*/
	public $useridnumber;
	/** 
	* @var int
	*/
	public $usermodified;

	/**
	* default constructor for class gradeItemRecord
	* @param int $dategraded
	* @param int $datesubmitted
	* @param string $error
	* @param int $feedback_format
	* @param float $grade
	* @param string $str_feedback
	* @param string $str_grade
	* @param string $str_long_grade
	* @param string $userid
	* @param string $useridnumber
	* @param int $usermodified
	* @return gradeItemRecord
	*/
	 public function gradeItemRecord($dategraded=0,$datesubmitted=0,$error='',$feedback_format=0,$grade=0.0,$str_feedback='',$str_grade='',$str_long_grade='',$userid='',$useridnumber='',$usermodified=0){
		 $this->dategraded=$dategraded   ;
		 $this->datesubmitted=$datesubmitted   ;
		 $this->error=$error   ;
		 $this->feedback_format=$feedback_format   ;
		 $this->grade=$grade   ;
		 $this->str_feedback=$str_feedback   ;
		 $this->str_grade=$str_grade   ;
		 $this->str_long_grade=$str_long_grade   ;
		 $this->userid=$userid   ;
		 $this->useridnumber=$useridnumber   ;
		 $this->usermodified=$usermodified   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getDategraded(){
		 return $this->dategraded;
	}


	/**
	* @return int
	*/
	public function getDatesubmitted(){
		 return $this->datesubmitted;
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
	public function getFeedback_format(){
		 return $this->feedback_format;
	}


	/**
	* @return float
	*/
	public function getGrade(){
		 return $this->grade;
	}


	/**
	* @return string
	*/
	public function getStr_feedback(){
		 return $this->str_feedback;
	}


	/**
	* @return string
	*/
	public function getStr_grade(){
		 return $this->str_grade;
	}


	/**
	* @return string
	*/
	public function getStr_long_grade(){
		 return $this->str_long_grade;
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
	public function getUseridnumber(){
		 return $this->useridnumber;
	}


	/**
	* @return int
	*/
	public function getUsermodified(){
		 return $this->usermodified;
	}

	/*set accessors */

	/**
	* @param int $dategraded
	* @return void
	*/
	public function setDategraded($dategraded){
		$this->dategraded=$dategraded;
	}


	/**
	* @param int $datesubmitted
	* @return void
	*/
	public function setDatesubmitted($datesubmitted){
		$this->datesubmitted=$datesubmitted;
	}


	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param int $feedback_format
	* @return void
	*/
	public function setFeedback_format($feedback_format){
		$this->feedback_format=$feedback_format;
	}


	/**
	* @param float $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param string $str_feedback
	* @return void
	*/
	public function setStr_feedback($str_feedback){
		$this->str_feedback=$str_feedback;
	}


	/**
	* @param string $str_grade
	* @return void
	*/
	public function setStr_grade($str_grade){
		$this->str_grade=$str_grade;
	}


	/**
	* @param string $str_long_grade
	* @return void
	*/
	public function setStr_long_grade($str_long_grade){
		$this->str_long_grade=$str_long_grade;
	}


	/**
	* @param string $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
	}


	/**
	* @param string $useridnumber
	* @return void
	*/
	public function setUseridnumber($useridnumber){
		$this->useridnumber=$useridnumber;
	}


	/**
	* @param int $usermodified
	* @return void
	*/
	public function setUsermodified($usermodified){
		$this->usermodified=$usermodified;
	}

}

?>
