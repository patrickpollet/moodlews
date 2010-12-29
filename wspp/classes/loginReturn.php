<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class loginReturn {
	/** 
	* @var integer
	*/
	public $client;
	/** 
	* @var string
	*/
	public $sessionkey;

	/**
	* default constructor for class loginReturn
	* @return loginReturn
	*/	 public function loginReturn() {
		 $this->client=0;
		 $this->sessionkey='';
	}
	/* get accessors */

	/**
	* @return integer
	*/
	public function getClient(){
		 return $this->client;
	}


	/**
	* @return string
	*/
	public function getSessionkey(){
		 return $this->sessionkey;
	}

	/*set accessors */

	/**
	* @param integer $client
	* @return void
	*/
	public function setClient($client){
		$this->client=$client;
	}


	/**
	* @param string $sessionkey
	* @return void
	*/
	public function setSessionkey($sessionkey){
		$this->sessionkey=$sessionkey;
	}

}

?>
