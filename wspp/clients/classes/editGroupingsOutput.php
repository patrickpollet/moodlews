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
	* @param groupingRecord[] $groupings
	* @return editGroupingsOutput
	*/
	 public function editGroupingsOutput($groupings=array()){
		 $this->groupings=$groupings   ;
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
