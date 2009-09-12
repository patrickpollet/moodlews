<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getUsersReturn {
	/** 
	* @var  (userRecords) array of userRecord
	*/
	public $users;
	/* full constructor */
	 public function getUsersReturn($users=array()){
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
