<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getUsersReturn {
	/** 
	* @var userRecord[]
	*/
	public $users;
	 public function getUsersReturn() {
		 $this->users=array();
	}
	/* get accessors */
	public function getUsers(){
		 return $this->users;
	}

	/*set accessors */
	public function setUsers($users){
		$this->users=$users;
	}

}

?>
