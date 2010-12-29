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
	public $itemid;
	/** 
	* @var float
	*/
	public $grade;
	/** 
	* @var string
	*/
	public $str_grade;
	/** 
	* @var string
	*/
	public $feedback;

	/**
	* default constructor for class gradeRecord
	* @param string $error
	* @param string $itemid
	* @param float $grade
	* @param string $str_grade
	* @param string $feedback
	* @return gradeRecord
	*/
	 public function gradeRecord($error='',$itemid='',$grade=0.0,$str_grade='',$feedback=''){
		 $this->error=$error   ;
		 $this->itemid=$itemid   ;
		 $this->grade=$grade   ;
		 $this->str_grade=$str_grade   ;
		 $this->feedback=$feedback   ;
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
	public function getItemid(){
		 return $this->itemid;
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
	public function getStr_grade(){
		 return $this->str_grade;
	}


	/**
	* @return string
	*/
	public function getFeedback(){
		 return $this->feedback;
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
	* @param string $itemid
	* @return void
	*/
	public function setItemid($itemid){
		$this->itemid=$itemid;
	}


	/**
	* @param float $grade
	* @return void
	*/
	public function setGrade($grade){
		$this->grade=$grade;
	}


	/**
	* @param string $str_grade
	* @return void
	*/
	public function setStr_grade($str_grade){
		$this->str_grade=$str_grade;
	}


	/**
	* @param string $feedback
	* @return void
	*/
	public function setFeedback($feedback){
		$this->feedback=$feedback;
	}

}

?>
