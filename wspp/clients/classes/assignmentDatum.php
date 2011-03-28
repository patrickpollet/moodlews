<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentDatum {
	/** 
	* @var string
	*/
	public $action;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var int
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
	* @var int
	*/
	public $format;
	/** 
	* @var string
	*/
	public $assignmenttype;
	/** 
	* @var int
	*/
	public $resubmit;
	/** 
	* @var int
	*/
	public $preventlate;
	/** 
	* @var int
	*/
	public $emailteachers;
	/** 
	* @var int
	*/
	public $var1;
	/** 
	* @var int
	*/
	public $var2;
	/** 
	* @var int
	*/
	public $var3;
	/** 
	* @var int
	*/
	public $var4;
	/** 
	* @var int
	*/
	public $var5;
	/** 
	* @var int
	*/
	public $maxbytes;
	/** 
	* @var int
	*/
	public $timedue;
	/** 
	* @var int
	*/
	public $timeavailable;
	/** 
	* @var int
	*/
	public $grade;
	/** 
	* @var int
	*/
	public $timemodified;

	/**
	* default constructor for class assignmentDatum
	* @param string $action
	* @param int $id
	* @param int $course
	* @param string $name
	* @param string $description
	* @param int $format
	* @param string $assignmenttype
	* @param int $resubmit
	* @param int $preventlate
	* @param int $emailteachers
	* @param int $var1
	* @param int $var2
	* @param int $var3
	* @param int $var4
	* @param int $var5
	* @param int $maxbytes
	* @param int $timedue
	* @param int $timeavailable
	* @param int $grade
	* @param int $timemodified
	* @return assignmentDatum
	*/
	 public function assignmentDatum($action='',$id=0,$course=0,$name='',$description='',$format=0,$assignmenttype='',$resubmit=0,$preventlate=0,$emailteachers=0,$var1=0,$var2=0,$var3=0,$var4=0,$var5=0,$maxbytes=0,$timedue=0,$timeavailable=0,$grade=0,$timemodified=0){
		 $this->action=$action   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->name=$name   ;
		 $this->description=$description   ;
		 $this->format=$format   ;
		 $this->assignmenttype=$assignmenttype   ;
		 $this->resubmit=$resubmit   ;
		 $this->preventlate=$preventlate   ;
		 $this->emailteachers=$emailteachers   ;
		 $this->var1=$var1   ;
		 $this->var2=$var2   ;
		 $this->var3=$var3   ;
		 $this->var4=$var4   ;
		 $this->var5=$var5   ;
		 $this->maxbytes=$maxbytes   ;
		 $this->timedue=$timedue   ;
		 $this->timeavailable=$timeavailable   ;
		 $this->grade=$grade   ;
		 $this->timemodified=$timemodified   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getAction(){
		 return $this->action;
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
	* @return int
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
	* @return int
	*/
	public function getResubmit(){
		 return $this->resubmit;
	}


	/**
	* @return int
	*/
	public function getPreventlate(){
		 return $this->preventlate;
	}


	/**
	* @return int
	*/
	public function getEmailteachers(){
		 return $this->emailteachers;
	}


	/**
	* @return int
	*/
	public function getVar1(){
		 return $this->var1;
	}


	/**
	* @return int
	*/
	public function getVar2(){
		 return $this->var2;
	}


	/**
	* @return int
	*/
	public function getVar3(){
		 return $this->var3;
	}


	/**
	* @return int
	*/
	public function getVar4(){
		 return $this->var4;
	}


	/**
	* @return int
	*/
	public function getVar5(){
		 return $this->var5;
	}


	/**
	* @return int
	*/
	public function getMaxbytes(){
		 return $this->maxbytes;
	}


	/**
	* @return int
	*/
	public function getTimedue(){
		 return $this->timedue;
	}


	/**
	* @return int
	*/
	public function getTimeavailable(){
		 return $this->timeavailable;
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
	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */

	/**
	* @param string $action
	* @return void
	*/
	public function setAction($action){
		$this->action=$action;
	}


	/**
	* @param int $id
	* @return void
	*/
	public function setId($id){
		$this->id=$id;
	}


	/**
	* @param int $course
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
	* @param int $format
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
	* @param int $resubmit
	* @return void
	*/
	public function setResubmit($resubmit){
		$this->resubmit=$resubmit;
	}


	/**
	* @param int $preventlate
	* @return void
	*/
	public function setPreventlate($preventlate){
		$this->preventlate=$preventlate;
	}


	/**
	* @param int $emailteachers
	* @return void
	*/
	public function setEmailteachers($emailteachers){
		$this->emailteachers=$emailteachers;
	}


	/**
	* @param int $var1
	* @return void
	*/
	public function setVar1($var1){
		$this->var1=$var1;
	}


	/**
	* @param int $var2
	* @return void
	*/
	public function setVar2($var2){
		$this->var2=$var2;
	}


	/**
	* @param int $var3
	* @return void
	*/
	public function setVar3($var3){
		$this->var3=$var3;
	}


	/**
	* @param int $var4
	* @return void
	*/
	public function setVar4($var4){
		$this->var4=$var4;
	}


	/**
	* @param int $var5
	* @return void
	*/
	public function setVar5($var5){
		$this->var5=$var5;
	}


	/**
	* @param int $maxbytes
	* @return void
	*/
	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}


	/**
	* @param int $timedue
	* @return void
	*/
	public function setTimedue($timedue){
		$this->timedue=$timedue;
	}


	/**
	* @param int $timeavailable
	* @return void
	*/
	public function setTimeavailable($timeavailable){
		$this->timeavailable=$timeavailable;
	}


	/**
	* @param int $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param int $timemodified
	* @return void
	*/
	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
