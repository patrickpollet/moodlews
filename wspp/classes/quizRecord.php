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

	/**
	* default constructor for class quizRecord
	* @return quizRecord
	*/	 public function quizRecord() {
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
	public function getIntro(){
		 return $this->intro;
	}


	/**
	* @return integer
	*/
	public function getTimeopen(){
		 return $this->timeopen;
	}


	/**
	* @return integer
	*/
	public function getTimeclose(){
		 return $this->timeclose;
	}


	/**
	* @return integer
	*/
	public function getShufflequestions(){
		 return $this->shufflequestions;
	}


	/**
	* @return integer
	*/
	public function getShuffleanswers(){
		 return $this->shuffleanswers;
	}


	/**
	* @return string
	*/
	public function getQuestions(){
		 return $this->questions;
	}


	/**
	* @return integer
	*/
	public function getTimelimit(){
		 return $this->timelimit;
	}


	/**
	* @return string
	*/
	public function getData(){
		 return $this->data;
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
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param integer $timeopen
	* @return void
	*/
	public function setTimeopen($timeopen){
		$this->timeopen=$timeopen;
	}


	/**
	* @param integer $timeclose
	* @return void
	*/
	public function setTimeclose($timeclose){
		$this->timeclose=$timeclose;
	}


	/**
	* @param integer $shufflequestions
	* @return void
	*/
	public function setShufflequestions($shufflequestions){
		$this->shufflequestions=$shufflequestions;
	}


	/**
	* @param integer $shuffleanswers
	* @return void
	*/
	public function setShuffleanswers($shuffleanswers){
		$this->shuffleanswers=$shuffleanswers;
	}


	/**
	* @param string $questions
	* @return void
	*/
	public function setQuestions($questions){
		$this->questions=$questions;
	}


	/**
	* @param integer $timelimit
	* @return void
	*/
	public function setTimelimit($timelimit){
		$this->timelimit=$timelimit;
	}


	/**
	* @param string $data
	* @return void
	*/
	public function setData($data){
		$this->data=$data;
	}

}

?>
