<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentSubmissionRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $assignment;
	/** 
	* @var  string
	*/
	public $assignmenttype;
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  integer
	*/
	public $timecreated;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $numfiles;
	/** 
	* @var  string
	*/
	public $data1;
	/** 
	* @var  string
	*/
	public $data2;
	/** 
	* @var  integer
	*/
	public $grade;
	/** 
	* @var  string
	*/
	public $submissioncomment;
	/** 
	* @var  integer
	*/
	public $format;
	/** 
	* @var  integer
	*/
	public $teacher;
	/** 
	* @var  integer
	*/
	public $timemarked;
	/** 
	* @var  integer
	*/
	public $mailed;
	/** 
	* @var  string
	*/
	public $useridnumber;
	/** 
	* @var  string
	*/
	public $userusername;
	/** 
	* @var  string
	*/
	public $useremail;
	/** 
	* @var  (fileRecords) array of fileRecord
	*/
	public $files;
	/* full constructor */
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
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getAssignment(){
		 return $this->assignment;
	}

	public function getAssignmenttype(){
		 return $this->assignmenttype;
	}

	public function getUserid(){
		 return $this->userid;
	}

	public function getTimecreated(){
		 return $this->timecreated;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	public function getNumfiles(){
		 return $this->numfiles;
	}

	public function getData1(){
		 return $this->data1;
	}

	public function getData2(){
		 return $this->data2;
	}

	public function getGrade(){
		 return $this->grade;
	}

	public function getSubmissioncomment(){
		 return $this->submissioncomment;
	}

	public function getFormat(){
		 return $this->format;
	}

	public function getTeacher(){
		 return $this->teacher;
	}

	public function getTimemarked(){
		 return $this->timemarked;
	}

	public function getMailed(){
		 return $this->mailed;
	}

	public function getUseridnumber(){
		 return $this->useridnumber;
	}

	public function getUserusername(){
		 return $this->userusername;
	}

	public function getUseremail(){
		 return $this->useremail;
	}

	public function getFiles(){
		 return $this->files;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setAssignment($assignment){
		$this->assignment=$assignment;
	}

	public function setAssignmenttype($assignmenttype){
		$this->assignmenttype=$assignmenttype;
	}

	public function setUserid($userid){
		$this->userid=$userid;
	}

	public function setTimecreated($timecreated){
		$this->timecreated=$timecreated;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

	public function setNumfiles($numfiles){
		$this->numfiles=$numfiles;
	}

	public function setData1($data1){
		$this->data1=$data1;
	}

	public function setData2($data2){
		$this->data2=$data2;
	}

	public function setGrade($grade){
		$this->grade=$grade;
	}

	public function setSubmissioncomment($submissioncomment){
		$this->submissioncomment=$submissioncomment;
	}

	public function setFormat($format){
		$this->format=$format;
	}

	public function setTeacher($teacher){
		$this->teacher=$teacher;
	}

	public function setTimemarked($timemarked){
		$this->timemarked=$timemarked;
	}

	public function setMailed($mailed){
		$this->mailed=$mailed;
	}

	public function setUseridnumber($useridnumber){
		$this->useridnumber=$useridnumber;
	}

	public function setUserusername($userusername){
		$this->userusername=$userusername;
	}

	public function setUseremail($useremail){
		$this->useremail=$useremail;
	}

	public function setFiles($files){
		$this->files=$files;
	}

}

?>
