<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editUsersInput {
	/** 
	* @var  userData
	*/
	public $users;
	/* constructor */
	 public function editUsersInput() {
		 $this->users=new userData();
	}
}

?>
