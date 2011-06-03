<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class quizRecord {
	/** 
	* @var int
	*/
	public $course;
	/** 
	* @var string
	*/
	public $data;
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var int
	*/
	public $id;
	/** 
	* @var string
	*/
	public $intro;
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $questions;
	/** 
	* @var int
	*/
	public $shuffleanswers;
	/** 
	* @var int
	*/
	public $shufflequestions;
	/** 
	* @var int
	*/
	public $timeclose;
	/** 
	* @var int
	*/
	public $timelimit;
	/** 
	* @var int
	*/
	public $timeopen;

	/**
	* default constructor for class quizRecord
	* @param int $course
	* @param string $data
	* @param string $error
	* @param int $id
	* @param string $intro
	* @param string $name
	* @param string $questions
	* @param int $shuffleanswers
	* @param int $shufflequestions
	* @param int $timeclose
	* @param int $timelimit
	* @param int $timeopen
	* @return quizRecord
	*/
	 public function quizRecord($course=0,$data='',$error='',$id=0,$intro='',$name='',$questions='',$shuffleanswers=0,$shufflequestions=0,$timeclose=0,$timelimit=0,$timeopen=0){
		 $this->course=$course   ;
		 $this->data=$data   ;
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->intro=$intro   ;
		 $this->name=$name   ;
		 $this->questions=$questions   ;
		 $this->shuffleanswers=$shuffleanswers   ;
		 $this->shufflequestions=$shufflequestions   ;
		 $this->timeclose=$timeclose   ;
		 $this->timelimit=$timelimit   ;
		 $this->timeopen=$timeopen   ;
	}
	/* get accessors */

	/**
	* @return int
	*/
	public function getCourse(){
		 return $this->course;
	}


	/**
	* @return string
	*/
	public function getData(){
		 return $this->data;
	}


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
	* @return string
	*/
	public function getIntro(){
		 return $this->intro;
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
	public function getQuestions(){
		 return $this->questions;
	}


	/**
	* @return int
	*/
	public function getShuffleanswers(){
		 return $this->shuffleanswers;
	}


	/**
	* @return int
	*/
	public function getShufflequestions(){
		 return $this->shufflequestions;
	}


	/**
	* @return int
	*/
	public function getTimeclose(){
		 return $this->timeclose;
	}


	/**
	* @return int
	*/
	public function getTimelimit(){
		 return $this->timelimit;
	}


	/**
	* @return int
	*/
	public function getTimeopen(){
		 return $this->timeopen;
	}

	/*set accessors */

	/**
	* @param int $course
	* @return void
	*/
	public function setCourse($course){
		$this->course=$course;
	}


	/**
	* @param string $data
	* @return void
	*/
	public function setData($data){
		$this->data=$data;
	}


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
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $questions
	* @return void
	*/
	public function setQuestions($questions){
		$this->questions=$questions;
	}


	/**
	* @param int $shuffleanswers
	* @return void
	*/
	public function setShuffleanswers($shuffleanswers){
		$this->shuffleanswers=$shuffleanswers;
	}


	/**
	* @param int $shufflequestions
	* @return void
	*/
	public function setShufflequestions($shufflequestions){
		$this->shufflequestions=$shufflequestions;
	}


	/**
	* @param int $timeclose
	* @return void
	*/
	public function setTimeclose($timeclose){
		$this->timeclose=$timeclose;
	}


	/**
	* @param int $timelimit
	* @return void
	*/
	public function setTimelimit($timelimit){
		$this->timelimit=$timelimit;
	}


	/**
	* @param int $timeopen
	* @return void
	*/
	public function setTimeopen($timeopen){
		$this->timeopen=$timeopen;
	}

}

?>
