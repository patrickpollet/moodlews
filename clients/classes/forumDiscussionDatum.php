<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumDiscussionDatum {
	/** 
	* @var string
	*/
	public $subject;
	/** 
	* @var string
	*/
	public $message;

	/**
	* default constructor for class forumDiscussionDatum
	* @param string $subject
	* @param string $message
	* @return forumDiscussionDatum
	*/
	 public function forumDiscussionDatum($subject='',$message=''){
		 $this->subject=$subject   ;
		 $this->message=$message   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getSubject(){
		 return $this->subject;
	}


	/**
	* @return string
	*/
	public function getMessage(){
		 return $this->message;
	}

	/*set accessors */

	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
	}


	/**
	* @param string $message
	* @return void
	*/
	public function setMessage($message){
		$this->message=$message;
	}

}

?>
