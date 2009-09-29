<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class userGrade {
	/** 
	* @var  float
	*/
	public $usergrade;
	/* full constructor */
	 public function userGrade($usergrade=0.0){
		 $this->usergrade=$usergrade   ;
	}
	/* get accessors */
	public function getUsergrade(){
		 return $this->usergrade;
	}

	/*set accessors */
	public function setUsergrade($usergrade){
		$this->usergrade=$usergrade;
	}

}

?>
