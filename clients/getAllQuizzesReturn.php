<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllQuizzesReturn {
	/** 
	* @var quizRecord[]
	*/
	public $quizzes;
	/* full constructor */
	 public function getAllQuizzesReturn($quizzes=array()){
		 $this->quizzes=$quizzes   ;
	}
	/* get accessors */
	public function getQuizzes(){
		 return $this->quizzes;
	}

	/*set accessors */
	public function setQuizzes($quizzes){
		$this->quizzes=$quizzes;
	}

}

?>
