<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class gradeRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var string
	*/
	public $feedback;
	/** 
	* @var float
	*/
	public $grade;
	/** 
	* @var string
	*/
	public $itemid;
	/** 
	* @var string
	*/
	public $str_grade;

	/**
	* default constructor for class gradeRecord
	* @param string $error
	* @param string $feedback
	* @param float $grade
	* @param string $itemid
	* @param string $str_grade
	* @return gradeRecord
	*/
	 public function gradeRecord($error='',$feedback='',$grade=0.0,$itemid='',$str_grade=''){
		 $this->error=$error   ;
		 $this->feedback=$feedback   ;
		 $this->grade=$grade   ;
		 $this->itemid=$itemid   ;
		 $this->str_grade=$str_grade   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return string
	*/
	public function getFeedback(){
		 return $this->feedback;
	}


	/**
	* @return float
	*/
	public function getGrade(){
		 return $this->grade;
	}


	/**
	* @return string
	*/
	public function getItemid(){
		 return $this->itemid;
	}


	/**
	* @return string
	*/
	public function getStr_grade(){
		 return $this->str_grade;
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
	* @param string $feedback
	* @return void
	*/
	public function setFeedback($feedback){
		$this->feedback=$feedback;
	}


	/**
	* @param float $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param string $itemid
	* @return void
	*/
	public function setItemid($itemid){
		$this->itemid=$itemid;
	}


	/**
	* @param string $str_grade
	* @return void
	*/
	public function setStr_grade($str_grade){
		$this->str_grade=$str_grade;
	}

}

?>
