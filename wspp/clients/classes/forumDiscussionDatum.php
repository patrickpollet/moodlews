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
	public $message;
	/** 
	* @var string
	*/
	public $subject;

	/**
	* default constructor for class forumDiscussionDatum
	* @param string $message
	* @param string $subject
	* @return forumDiscussionDatum
	*/
	 public function forumDiscussionDatum($message='',$subject=''){
		 $this->message=$message   ;
		 $this->subject=$subject   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getMessage(){
		 return $this->message;
	}


	/**
	* @return string
	*/
	public function getSubject(){
		 return $this->subject;
	}

	/*set accessors */

	/**
	* @param string $message
	* @return void
	*/
	public function setMessage($message){
		$this->message=$message;
	}


	/**
	* @param string $subject
	* @return void
	*/
	public function setSubject($subject){
		$this->subject=$subject;
	}

}

?>
