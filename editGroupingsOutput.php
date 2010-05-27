<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsOutput {
	/** 
	* @var  (groupingRecords) array of groupingRecord
	*/
	public $groupings;
	 public function editGroupingsOutput() {
		 $this->groupings=array();
	}
	/* get accessors */
	public function getGroupings(){
		 return $this->groupings;
	}

	/*set accessors */
	public function setGroupings($groupings){
		$this->groupings=$groupings;
	}

}

?>
