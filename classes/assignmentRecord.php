<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentRecord {
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
	public $course;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $description;
	/** 
	* @var integer
	*/
	public $format;
	/** 
	* @var string
	*/
	public $assignmenttype;
	/** 
	* @var integer
	*/
	public $resubmit;
	/** 
	* @var integer
	*/
	public $preventlate;
	/** 
	* @var integer
	*/
	public $emailteachers;
	/** 
	* @var integer
	*/
	public $var1;
	/** 
	* @var integer
	*/
	public $var2;
	/** 
	* @var integer
	*/
	public $var3;
	/** 
	* @var integer
	*/
	public $var4;
	/** 
	* @var integer
	*/
	public $var5;
	/** 
	* @var integer
	*/
	public $maxbytes;
	/** 
	* @var integer
	*/
	public $timedue;
	/** 
	* @var integer
	*/
	public $timeavailable;
	/** 
	* @var integer
	*/
	public $grade;
	/** 
	* @var integer
	*/
	public $timemodified;

	/**
	* default constructor for class assignmentRecord
	* @return assignmentRecord
	*/	 public function assignmentRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->course=0;
		 $this->name='';
		 $this->description='';
		 $this->format=0;
		 $this->assignmenttype='';
		 $this->resubmit=0;
		 $this->preventlate=0;
		 $this->emailteachers=0;
		 $this->var1=0;
		 $this->var2=0;
		 $this->var3=0;
		 $this->var4=0;
		 $this->var5=0;
		 $this->maxbytes=0;
		 $this->timedue=0;
		 $this->timeavailable=0;
		 $this->grade=0;
		 $this->timemodified=0;
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
	public function getCourse(){
		 return $this->course;
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
	public function getDescription(){
		 return $this->description;
	}


	/**
	* @return integer
	*/
	public function getFormat(){
		 return $this->format;
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
	public function getResubmit(){
		 return $this->resubmit;
	}


	/**
	* @return integer
	*/
	public function getPreventlate(){
		 return $this->preventlate;
	}


	/**
	* @return integer
	*/
	public function getEmailteachers(){
		 return $this->emailteachers;
	}


	/**
	* @return integer
	*/
	public function getVar1(){
		 return $this->var1;
	}


	/**
	* @return integer
	*/
	public function getVar2(){
		 return $this->var2;
	}


	/**
	* @return integer
	*/
	public function getVar3(){
		 return $this->var3;
	}


	/**
	* @return integer
	*/
	public function getVar4(){
		 return $this->var4;
	}


	/**
	* @return integer
	*/
	public function getVar5(){
		 return $this->var5;
	}


	/**
	* @return integer
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
	}


	/**
	* @return integer
	*/
	public function getTimedue(){
		 return $this->timedue;
	}


	/**
	* @return integer
	*/
	public function getTimeavailable(){
		 return $this->timeavailable;
	}


	/**
	* @return integer
	*/
	public function getGrade(){
		 return $this->grade;
	}


	/**
	* @return integer
	*/
	public function getTimemodified(){
		 return $this->timemodified;
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
	* @param integer $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $description
	* @return void
	*/
	public function setDescription($description){
		$this->description=$description;
	}


	/**
	* @param integer $format
	* @return void
	*/
	public function setFormat($format){
		$this->format=$format;
	}


	/**
	* @param string $assignmenttype
	* @return void
	*/
	public function setAssignmenttype($assignmenttype){
		$this->assignmenttype=$assignmenttype;
	}


	/**
	* @param integer $resubmit
	* @return void
	*/
	public function setResubmit($resubmit){
		$this->resubmit=$resubmit;
	}


	/**
	* @param integer $preventlate
	* @return void
	*/
	public function setPreventlate($preventlate){
		$this->preventlate=$preventlate;
	}


	/**
	* @param integer $emailteachers
	* @return void
	*/
	public function setEmailteachers($emailteachers){
		$this->emailteachers=$emailteachers;
	}


	/**
	* @param integer $var1
	* @return void
	*/
	public function setVar1($var1){
		$this->var1=$var1;
	}


	/**
	* @param integer $var2
	* @return void
	*/
	public function setVar2($var2){
		$this->var2=$var2;
	}


	/**
	* @param integer $var3
	* @return void
	*/
	public function setVar3($var3){
		$this->var3=$var3;
	}


	/**
	* @param integer $var4
	* @return void
	*/
	public function setVar4($var4){
		$this->var4=$var4;
	}


	/**
	* @param integer $var5
	* @return void
	*/
	public function setVar5($var5){
		$this->var5=$var5;
	}


	/**
	* @param integer $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param integer $timedue
	* @return void
	*/
	public function setTimedue($timedue){
		$this->timedue=$timedue;
	}


	/**
	* @param integer $timeavailable
	* @return void
	*/
	public function setTimeavailable($timeavailable){
		$this->timeavailable=$timeavailable;
	}


	/**
	* @param integer $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param integer $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
