<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class loginReturn {
	/** 
	* @var int
	*/
	public $client;
	/** 
	* @var string
	*/
	public $sessionkey;

	/**
	* default constructor for class loginReturn
	* @param int $client
	* @param string $sessionkey
	* @return loginReturn
	*/
	 public function loginReturn($client=0,$sessionkey=''){
		 $this->client=$client   ;
		 $this->sessionkey=$sessionkey   ;
	}
	/* get accessors */

	/**
	* @return int
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
	* @param int $client
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
