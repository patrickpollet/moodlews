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
	 public function loginReturn() {
		 $this->client=0;
		 $this->sessionkey='';
	}
	/* get accessors */
	public function getClient(){
		 return $this->client;
	}

	public function getSessionkey(){
		 return $this->sessionkey;
	}

	/*set accessors */
	public function setClient($client){
		$this->client=$client;
	}

	public function setSessionkey($sessionkey){
		$this->sessionkey=$sessionkey;
	}

}

?>
