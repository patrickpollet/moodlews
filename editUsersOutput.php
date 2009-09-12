<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersOutput {
	/** 
	* @var  (userRecords) array of userRecord
	*/
	public $users;
	 public function editUsersOutput() {
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
