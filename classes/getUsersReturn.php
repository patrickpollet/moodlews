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

	/**
	* default constructor for class getUsersReturn
	* @return getUsersReturn
	*/	 public function getUsersReturn() {
		 $this->users=array();
	}
	/* get accessors */

	/**
	* @return userRecord[]
	*/
	public function getUsers(){
		 return $this->users;
	}

	/*set accessors */

	/**
	* @param userRecord[] $users
	* @return void
	*/
	public function setUsers($users){
		$this->users=$users;
	}

}

?>
