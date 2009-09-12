<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class loginReturn {
	/** 
	* @var  integer
	*/
	public $client;
	/** 
	* @var  string
	*/
	public $sessionkey;
	/* constructor */
	 public function loginReturn() {
		 $this->client=0;
		 $this->sessionkey='';
	}
}

?>
