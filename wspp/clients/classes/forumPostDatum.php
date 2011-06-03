<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class forumPostDatum {
	/** 
	* @var string
	*/
	public $message;
	/** 
	* @var string
	*/
	public $subject;

	/**
	* default constructor for class forumPostDatum
	* @param string $message
	* @param string $subject
	* @return forumPostDatum
	*/
	 public function forumPostDatum($message='',$subject=''){
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
