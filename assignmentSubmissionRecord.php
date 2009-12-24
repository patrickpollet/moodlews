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
	 public function assignmentSubmissionRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->assignment=0;
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
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getAssignment(){
		 return $this->assignment;
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
