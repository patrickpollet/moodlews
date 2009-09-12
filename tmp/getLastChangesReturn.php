<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getLastChangesReturn {
	/** 
	* @var  changeRecords
	*/
	public $changes;
	/* constructor */
	 public function getLastChangesReturn() {
		 $this->changes=new changeRecords();
	}
}

?>
