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
	* @var int
	*/
	public $id;
	/** 
	* @var int
	*/
	public $assignment;
	/** 
	* @var string
	*/
	public $assignmenttype;
	/** 
	* @var int
	*/
	public $userid;
	/** 
	* @var int
	*/
	public $timecreated;
	/** 
	* @var int
	*/
	public $timemodified;
	/** 
	* @var int
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
	* @var int
	*/
	public $grade;
	/** 
	* @var string
	*/
	public $submissioncomment;
	/** 
	* @var int
	*/
	public $format;
	/** 
	* @var int
	*/
	public $teacher;
	/** 
	* @var int
	*/
	public $timemarked;
	/** 
	* @var int
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
	* @param string $error
	* @param int $id
	* @param int $assignment
	* @param string $assignmenttype
	* @param int $userid
	* @param int $timecreated
	* @param int $timemodified
	* @param int $numfiles
	* @param string $data1
	* @param string $data2
	* @param int $grade
	* @param string $submissioncomment
	* @param int $format
	* @param int $teacher
	* @param int $timemarked
	* @param int $mailed
	* @param string $useridnumber
	* @param string $userusername
	* @param string $useremail
	* @param fileRecord[] $files
	* @return assignmentSubmissionRecord
	*/
	 public function assignmentSubmissionRecord($error='',$id=0,$assignment=0,$assignmenttype='',$userid=0,$timecreated=0,$timemodified=0,$numfiles=0,$data1='',$data2='',$grade=0,$submissioncomment='',$format=0,$teacher=0,$timemarked=0,$mailed=0,$useridnumber='',$userusername='',$useremail='',$files=array()){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->assignment=$assignment   ;
		 $this->assignmenttype=$assignmenttype   ;
		 $this->userid=$userid   ;
		 $this->timecreated=$timecreated   ;
		 $this->timemodified=$timemodified   ;
		 $this->numfiles=$numfiles   ;
		 $this->data1=$data1   ;
		 $this->data2=$data2   ;
		 $this->grade=$grade   ;
		 $this->submissioncomment=$submissioncomment   ;
		 $this->format=$format   ;
		 $this->teacher=$teacher   ;
		 $this->timemarked=$timemarked   ;
		 $this->mailed=$mailed   ;
		 $this->useridnumber=$useridnumber   ;
		 $this->userusername=$userusername   ;
		 $this->useremail=$useremail   ;
		 $this->files=$files   ;
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
	* @return int
	*/
	public function getUserid(){
		 return $this->userid;
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
	* @return int
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
	* @return int
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
	* @return int
	*/
	public function getFormat(){
		 return $this->format;
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
	public function getTimemarked(){
		 return $this->timemarked;
	}


	/**
	* @return int
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
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


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
	* @param int $userid
	* @return void
	*/
	public function setUserid($userid){
		$this->userid=$userid;
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
	* @param int $numfiles
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
	* @param int $grade
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
	* @param int $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param int $teacher
	* @return void
	*/
	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}


	/**
	* @param int $timemarked
	* @return void
	*/
	public function setTimemarked($timemarked){
		$this->timemarked=$timemarked;
	}


	/**
	* @param int $mailed
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
