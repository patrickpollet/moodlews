<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentSubmissionRecord {
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
	public $assignment;
	/** 
	* @var string
	*/
	public $assignmenttype;
	/** 
	* @var integer
	*/
	public $userid;
	/** 
	* @var integer
	*/
	public $timecreated;
	/** 
	* @var integer
	*/
	public $timemodified;
	/** 
	* @var integer
	*/
	public $numfiles;
	/** 
	* @var string
	*/
	public $data1;
	/** 
	* @var string
	*/
	public $data2;
	/** 
	* @var integer
	*/
	public $grade;
	/** 
	* @var string
	*/
	public $submissioncomment;
	/** 
	* @var integer
	*/
	public $format;
	/** 
	* @var integer
	*/
	public $teacher;
	/** 
	* @var integer
	*/
	public $timemarked;
	/** 
	* @var integer
	*/
	public $mailed;
	/** 
	* @var string
	*/
	public $useridnumber;
	/** 
	* @var string
	*/
	public $userusername;
	/** 
	* @var string
	*/
	public $useremail;
	/** 
	* @var fileRecord[]
	*/
	public $files;

	/**
	* default constructor for class assignmentSubmissionRecord
	* @return assignmentSubmissionRecord
	*/	 public function assignmentSubmissionRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->assignment=0;
		 $this->assignmenttype='';
		 $this->userid=0;
		 $this->timecreated=0;
		 $this->timemodified=0;
		 $this->numfiles=0;
		 $this->data1='';
		 $this->data2='';
		 $this->grade=0;
		 $this->submissioncomment='';
		 $this->format=0;
		 $this->teacher=0;
		 $this->timemarked=0;
		 $this->mailed=0;
		 $this->useridnumber='';
		 $this->userusername='';
		 $this->useremail='';
		 $this->files=array();
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
	public function getAssignment(){
		 return $this->assignment;
	}


	/**
	* @return string
	*/
	public function getAssignmenttype(){
		 return $this->assignmenttype;
	}


	/**
	* @return integer
	*/
	public function getUserid(){
		 return $this->userid;
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
	* @return integer
	*/
	public function getNumfiles(){
		 return $this->numfiles;
	}


	/**
	* @return string
	*/
	public function getData1(){
		 return $this->data1;
	}


	/**
	* @return string
	*/
	public function getData2(){
		 return $this->data2;
	}


	/**
	* @return integer
	*/
	public function getGrade(){
		 return $this->grade;
	}


	/**
	* @return string
	*/
	public function getSubmissioncomment(){
		 return $this->submissioncomment;
	}


	/**
	* @return integer
	*/
	public function getFormat(){
		 return $this->format;
	}


	/**
	* @return integer
	*/
	public function getTeacher(){
		 return $this->teacher;
	}


	/**
	* @return integer
	*/
	public function getTimemarked(){
		 return $this->timemarked;
	}


	/**
	* @return integer
	*/
	public function getMailed(){
		 return $this->mailed;
	}


	/**
	* @return string
	*/
	public function getUseridnumber(){
		 return $this->useridnumber;
	}


	/**
	* @return string
	*/
	public function getUserusername(){
		 return $this->userusername;
	}


	/**
	* @return string
	*/
	public function getUseremail(){
		 return $this->useremail;
	}


	/**
	* @return fileRecord[]
	*/
	public function getFiles(){
		 return $this->files;
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
	* @param integer $assignment
	* @return void
	*/
	public function setAssignment($assignment){
		$this->assignment=$assignment;
	}


	/**
	* @param string $assignmenttype
	* @return void
	*/
	public function setAssignmenttype($assignmenttype){
		$this->assignmenttype=$assignmenttype;
	}


	/**
	* @param integer $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
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
	* @param integer $numfiles
	* @return void
	*/
	public function setNumfiles($numfiles){
		$this->numfiles=$numfiles;
	}


	/**
	* @param string $data1
	* @return void
	*/
	public function setData1($data1){
		$this->data1=$data1;
	}


	/**
	* @param string $data2
	* @return void
	*/
	public function setData2($data2){
		$this->data2=$data2;
	}


	/**
	* @param integer $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param string $submissioncomment
	* @return void
	*/
	public function setSubmissioncomment($submissioncomment){
		$this->submissioncomment=$submissioncomment;
	}


	/**
	* @param integer $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param integer $teacher
	* @return void
	*/
	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}


	/**
	* @param integer $timemarked
	* @return void
	*/
	public function setTimemarked($timemarked){
		$this->timemarked=$timemarked;
	}


	/**
	* @param integer $mailed
	* @return void
	*/
	public function setMailed($mailed){
		$this->mailed=$mailed;
	}


	/**
	* @param string $useridnumber
	* @return void
	*/
	public function setUseridnumber($useridnumber){
		$this->useridnumber=$useridnumber;
	}


	/**
	* @param string $userusername
	* @return void
	*/
	public function setUserusername($userusername){
		$this->userusername=$userusername;
	}


	/**
	* @param string $useremail
	* @return void
	*/
	public function setUseremail($useremail){
		$this->useremail=$useremail;
	}


	/**
	* @param fileRecord[] $files
	* @return void
	*/
	public function setFiles($files){
		$this->files=$files;
	}

}

?>
