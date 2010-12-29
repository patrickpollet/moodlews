<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getMessagesReturn {
	/** 
	* @var messageRecord[]
	*/
	public $messages;

	/**
	* default constructor for class getMessagesReturn
	* @return getMessagesReturn
	*/	 public function getMessagesReturn() {
		 $this->messages=array();
	}
	/* get accessors */

	/**
	* @return messageRecord[]
	*/
	public function getMessages(){
		 return $this->messages;
	}

	/*set accessors */

	/**
	* @param messageRecord[] $messages
	* @return void
	*/
	public function setMessages($messages){
		$this->messages=$messages;
	}

}

?>
