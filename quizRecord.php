<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class quizRecord {
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
	public $intro;
	/** 
	* @var integer
	*/
	public $timeopen;
	/** 
	* @var integer
	*/
	public $timeclose;
	/** 
	* @var integer
	*/
	public $shufflequestions;
	/** 
	* @var integer
	*/
	public $shuffleanswers;
	/** 
	* @var string
	*/
	public $questions;
	/** 
	* @var integer
	*/
	public $timelimit;
	/** 
	* @var string
	*/
	public $data;
	 public function quizRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->course=0;
		 $this->name='';
		 $this->intro='';
		 $this->timeopen=0;
		 $this->timeclose=0;
		 $this->shufflequestions=0;
		 $this->shuffleanswers=0;
		 $this->questions='';
		 $this->timelimit=0;
		 $this->data='';
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

	public function getIntro(){
		 return $this->intro;
	}

	public function getTimeopen(){
		 return $this->timeopen;
	}

	public function getTimeclose(){
		 return $this->timeclose;
	}

	public function getShufflequestions(){
		 return $this->shufflequestions;
	}

	public function getShuffleanswers(){
		 return $this->shuffleanswers;
	}

	public function getQuestions(){
		 return $this->questions;
	}

	public function getTimelimit(){
		 return $this->timelimit;
	}

	public function getData(){
		 return $this->data;
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

	public function setIntro($intro){
		$this->intro=$intro;
	}

	public function setTimeopen($timeopen){
		$this->timeopen=$timeopen;
	}

	public function setTimeclose($timeclose){
		$this->timeclose=$timeclose;
	}

	public function setShufflequestions($shufflequestions){
		$this->shufflequestions=$shufflequestions;
	}

	public function setShuffleanswers($shuffleanswers){
		$this->shuffleanswers=$shuffleanswers;
	}

	public function setQuestions($questions){
		$this->questions=$questions;
	}

	public function setTimelimit($timelimit){
		$this->timelimit=$timelimit;
	}

	public function setData($data){
		$this->data=$data;
	}

}

?>
