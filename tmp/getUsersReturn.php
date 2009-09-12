<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getUsersReturn {
	/** 
	* @var  userRecords
	*/
	public $users;
	/* constructor */
	 public function getUsersReturn() {
		 $this->users=new userRecords();
	}
}

?>
