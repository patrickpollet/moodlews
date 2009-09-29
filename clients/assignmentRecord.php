<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class assignmentRecord {
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
	public $course;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $format;
	/** 
	* @var  string
	*/
	public $assignmenttype;
	/** 
	* @var  integer
	*/
	public $resubmit;
	/** 
	* @var  integer
	*/
	public $preventlate;
	/** 
	* @var  integer
	*/
	public $emailteachers;
	/** 
	* @var  integer
	*/
	public $var1;
	/** 
	* @var  integer
	*/
	public $var2;
	/** 
	* @var  integer
	*/
	public $var3;
	/** 
	* @var  integer
	*/
	public $var4;
	/** 
	* @var  integer
	*/
	public $var5;
	/** 
	* @var  integer
	*/
	public $maxbytes;
	/** 
	* @var  integer
	*/
	public $timedue;
	/** 
	* @var  integer
	*/
	public $timeavailable;
	/** 
	* @var  integer
	*/
	public $grade;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/* full constructor */
	 public function assignmentRecord($error='',$id=0,$course=0,$name='',$description='',$format=0,$assignmenttype='',$resubmit=0,$preventlate=0,$emailteachers=0,$var1=0,$var2=0,$var3=0,$var4=0,$var5=0,$maxbytes=0,$timedue=0,$timeavailable=0,$grade=0,$timemodified=0){
		 $this->error=$error   ;
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
	public function getError(){
		 return $this->error;
	}

	public function getId(){
		 return $this->id;
	}

	public function getCourse(){
		 return $this->course;
	}

	public function getName(){
		 return $this->name;
	}

	public function getDescription(){
		 return $this->description;
	}

	public function getFormat(){
		 return $this->format;
	}

	public function getAssignmenttype(){
		 return $this->assignmenttype;
	}

	public function getResubmit(){
		 return $this->resubmit;
	}

	public function getPreventlate(){
		 return $this->preventlate;
	}

	public function getEmailteachers(){
		 return $this->emailteachers;
	}

	public function getVar1(){
		 return $this->var1;
	}

	public function getVar2(){
		 return $this->var2;
	}

	public function getVar3(){
		 return $this->var3;
	}

	public function getVar4(){
		 return $this->var4;
	}

	public function getVar5(){
		 return $this->var5;
	}

	public function getMaxbytes(){
		 return $this->maxbytes;
	}

	public function getTimedue(){
		 return $this->timedue;
	}

	public function getTimeavailable(){
		 return $this->timeavailable;
	}

	public function getGrade(){
		 return $this->grade;
	}

	public function getTimemodified(){
		 return $this->timemodified;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCourse($course){
		$this->course=$course;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setFormat($format){
		$this->format=$format;
	}

	public function setAssignmenttype($assignmenttype){
		$this->assignmenttype=$assignmenttype;
	}

	public function setResubmit($resubmit){
		$this->resubmit=$resubmit;
	}

	public function setPreventlate($preventlate){
		$this->preventlate=$preventlate;
	}

	public function setEmailteachers($emailteachers){
		$this->emailteachers=$emailteachers;
	}

	public function setVar1($var1){
		$this->var1=$var1;
	}

	public function setVar2($var2){
		$this->var2=$var2;
	}

	public function setVar3($var3){
		$this->var3=$var3;
	}

	public function setVar4($var4){
		$this->var4=$var4;
	}

	public function setVar5($var5){
		$this->var5=$var5;
	}

	public function setMaxbytes($maxbytes){
		$this->maxbytes=$maxbytes;
	}

	public function setTimedue($timedue){
		$this->timedue=$timedue;
	}

	public function setTimeavailable($timeavailable){
		$this->timeavailable=$timeavailable;
	}

	public function setGrade($grade){
		$this->grade=$grade;
	}

	public function setTimemodified($timemodified){
		$this->timemodified=$timemodified;
	}

}

?>
