<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersOutput {
	/** 
	* @var  userRecords
	*/
	public $users;
	/* constructor */
	 public function editUsersOutput() {
		 $this->users=new userRecords();
	}
}

?>
