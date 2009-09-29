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
	 public function userGrade() {
		 $this->usergrade=0.0;
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
