<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getLastChangesReturn {
	/** 
	* @var  (changeRecords) array of changeRecord
	*/
	public $changes;
	 public function getLastChangesReturn() {
		 $this->changes=array();
	}
	/* get accessors */
	public function getChanges(){
		 return $this->changes;
	}

	/*set accessors */
	public function setChanges($changes){
		$this->changes=$changes;
	}

}

?>
