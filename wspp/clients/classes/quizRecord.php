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
	public $intro;
	/** 
	* @var int
	*/
	public $timeopen;
	/** 
	* @var int
	*/
	public $timeclose;
	/** 
	* @var int
	*/
	public $shufflequestions;
	/** 
	* @var int
	*/
	public $shuffleanswers;
	/** 
	* @var string
	*/
	public $questions;
	/** 
	* @var int
	*/
	public $timelimit;
	/** 
	* @var string
	*/
	public $data;

	/**
	* default constructor for class quizRecord
	* @param string $error
	* @param int $id
	* @param int $course
	* @param string $name
	* @param string $intro
	* @param int $timeopen
	* @param int $timeclose
	* @param int $shufflequestions
	* @param int $shuffleanswers
	* @param string $questions
	* @param int $timelimit
	* @param string $data
	* @return quizRecord
	*/
	 public function quizRecord($error='',$id=0,$course=0,$name='',$intro='',$timeopen=0,$timeclose=0,$shufflequestions=0,$shuffleanswers=0,$questions='',$timelimit=0,$data=''){
		 $this->error=$error   ;
		 $this->id=$id   ;
		 $this->course=$course   ;
		 $this->name=$name   ;
		 $this->intro=$intro   ;
		 $this->timeopen=$timeopen   ;
		 $this->timeclose=$timeclose   ;
		 $this->shufflequestions=$shufflequestions   ;
		 $this->shuffleanswers=$shuffleanswers   ;
		 $this->questions=$questions   ;
		 $this->timelimit=$timelimit   ;
		 $this->data=$data   ;
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
	* @return int
	*/
	public function getTimeopen(){
		 return $this->timeopen;
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
	public function getShufflequestions(){
		 return $this->shufflequestions;
	}


	/**
	* @return int
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
	* @return int
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
	* @param string $intro
	* @return void
	*/
	public function setIntro($intro){
		$this->intro=$intro;
	}


	/**
	* @param int $timeopen
	* @return void
	*/
	public function setTimeopen($timeopen){
		$this->timeopen=$timeopen;
	}


	/**
	* @param int $timeclose
	* @return void
	*/
	public function setTimeclose($timeclose){
		$this->timeclose=$timeclose;
	}


	/**
	* @param int $shufflequestions
	* @return void
	*/
	public function setShufflequestions($shufflequestions){
		$this->shufflequestions=$shufflequestions;
	}


	/**
	* @param int $shuffleanswers
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
	* @param int $timelimit
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
