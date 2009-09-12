<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersInput {
	/** 
	* @var  (userData) array of userDatum
	*/
	public $users;
	/* full constructor */
	 public function editUsersInput($users=array()){
		 $this->users=$users   ;
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
