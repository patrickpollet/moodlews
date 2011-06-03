<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentSubmissionRecord {
	/** 
	* @var int
	*/
	public $assignment;
	/** 
	* @var string
	*/
	public $assignmenttype;
	/** 
	* @var string
	*/
	public $data1;
	/** 
	* @var string
	*/
	public $data2;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var fileRecord[]
	*/
	public $files;
	/** 
	* @var int
	*/
	public $format;
	/** 
	* @var int
	*/
	public $grade;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $mailed;
	/** 
	* @var int
	*/
	public $numfiles;
	/** 
	* @var string
	*/
	public $submissioncomment;
	/** 
	* @var int
	*/
	public $teacher;
	/** 
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $timemarked;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var string
	*/
	public $useremail;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var string
	*/
	public $useridnumber;
	/** 
	* @var string
	*/
	public $userusername;

	/**
	* default constructor for class assignmentSubmissionRecord
	* @param int $assignment
	* @param string $assignmenttype
	* @param string $data1
	* @param string $data2
	* @param string $error
	* @param fileRecord[] $files
	* @param int $format
	* @param int $grade
	* @param int $id
	* @param int $mailed
	* @param int $numfiles
	* @param string $submissioncomment
	* @param int $teacher
	* @param int $timecreated
	* @param int $timemarked
	* @param int $timemodified
	* @param string $useremail
	* @param int $userid
	* @param string $useridnumber
	* @param string $userusername
	* @return assignmentSubmissionRecord
	*/
	 public function assignmentSubmissionRecord($assignment=0,$assignmenttype='',$data1='',$data2='',$error='',$files=array(),$format=0,$grade=0,$id=0,$mailed=0,$numfiles=0,$submissioncomment='',$teacher=0,$timecreated=0,$timemarked=0,$timemodified=0,$useremail='',$userid=0,$useridnumber='',$userusername=''){
		 $this->assignment=$assignment   ;
		 $this->assignmenttype=$assignmenttype   ;
		 $this->data1=$data1   ;
		 $this->data2=$data2   ;
		 $this->error=$error   ;
		 $this->files=$files   ;
		 $this->format=$format   ;
		 $this->grade=$grade   ;
		 $this->id=$id   ;
		 $this->mailed=$mailed   ;
		 $this->numfiles=$numfiles   ;
		 $this->submissioncomment=$submissioncomment   ;
		 $this->teacher=$teacher   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemarked=$timemarked   ;
		 $this->timemodified=$timemodified   ;
		 $this->useremail=$useremail   ;
		 $this->userid=$userid   ;
		 $this->useridnumber=$useridnumber   ;
		 $this->userusername=$userusername   ;
	}
	/* get accessors */

	/**
	* @return int
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
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return fileRecord[]
	*/
	public function getFiles(){
		 return $this->files;
	}


	/**
	* @return int
	*/
	public function getFormat(){
		 return $this->format;
	}


	/**
	* @return int
	*/
	public function getGrade(){
		 return $this->grade;
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
	public function getMailed(){
		 return $this->mailed;
	}


	/**
	* @return int
	*/
	public function getNumfiles(){
		 return $this->numfiles;
	}


	/**
	* @return string
	*/
	public function getSubmissioncomment(){
		 return $this->submissioncomment;
	}


	/**
	* @return int
	*/
	public function getTeacher(){
		 return $this->teacher;
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
	public function getTimemarked(){
		 return $this->timemarked;
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
	public function getUseremail(){
		 return $this->useremail;
	}


	/**
	* @return int
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
	* @return string
	*/
	public function getUserusername(){
		 return $this->userusername;
	}

	/*set accessors */

	/**
	* @param int $assignment
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
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param fileRecord[] $files
	* @return void
	*/
	public function setFiles($files){
		$this->files=$files;
	}


	/**
	* @param int $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param int $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $mailed
	* @return void
	*/
	public function setMailed($mailed){
		$this->mailed=$mailed;
	}


	/**
	* @param int $numfiles
	* @return void
	*/
	public function setNumfiles($numfiles){
		$this->numfiles=$numfiles;
	}


	/**
	* @param string $submissioncomment
	* @return void
	*/
	public function setSubmissioncomment($submissioncomment){
		$this->submissioncomment=$submissioncomment;
	}


	/**
	* @param int $teacher
	* @return void
	*/
	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}


	/**
	* @param int $timecreated
	* @return void
	*/
	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}


	/**
	* @param int $timemarked
	* @return void
	*/
	public function setTimemarked($timemarked){
		$this->timemarked=$timemarked;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}


	/**
	* @param string $useremail
	* @return void
	*/
	public function setUseremail($useremail){
		$this->useremail=$useremail;
	}


	/**
	* @param int $userid
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
	* @param string $userusername
	* @return void
	*/
	public function setUserusername($userusername){
		$this->userusername=$userusername;
	}

}

?>
