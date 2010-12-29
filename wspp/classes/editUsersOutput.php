<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersOutput {
	/** 
	* @var userRecord[]
	*/
	public $users;

	/**
	* default constructor for class editUsersOutput
	* @return editUsersOutput
	*/	 public function editUsersOutput() {
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
