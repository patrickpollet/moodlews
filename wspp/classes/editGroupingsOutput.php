<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsOutput {
	/** 
	* @var groupingRecord[]
	*/
	public $groupings;

	/**
	* default constructor for class editGroupingsOutput
	* @return editGroupingsOutput
	*/	 public function editGroupingsOutput() {
		 $this->groupings=array();
	}
	/* get accessors */

	/**
	* @return groupingRecord[]
	*/
	public function getGroupings(){
		 return $this->groupings;
	}

	/*set accessors */

	/**
	* @param groupingRecord[] $groupings
	* @return void
	*/
	public function setGroupings($groupings){
		$this->groupings=$groupings;
	}

}

?>
