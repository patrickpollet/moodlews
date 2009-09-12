<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGroupsReturn {
	/** 
	* @var  groupRecords
	*/
	public $groups;
	/* constructor */
	 public function getGroupsReturn() {
		 $this->groups=new groupRecords();
	}
}

?>
