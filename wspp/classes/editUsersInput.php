<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersInput {
	/** 
	* @var userDatum[]
	*/
	public $users;

	/**
	* default constructor for class editUsersInput
	* @return editUsersInput
	*/	 public function editUsersInput() {
		 $this->users=array();
	}
	/* get accessors */

	/**
	* @return userDatum[]
	*/
	public function getUsers(){
		 return $this->users;
	}

	/*set accessors */

	/**
	* @param userDatum[] $users
	* @return void
	*/
	public function setUsers($users){
		$this->users=$users;
	}

}

?>
