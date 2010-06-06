<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllQuizzesReturn {
	/** 
	* @var  (quizRecords) array of quizRecord
	*/
	public $quizzes;
	 public function getAllQuizzesReturn() {
		 $this->quizzes=array();
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
