<?php
/**
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
	/* full constructor */
	 public function loginReturn($client=0,$sessionkey=''){
		 $this->client=$client   ;
		 $this->sessionkey=$sessionkey   ;
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
