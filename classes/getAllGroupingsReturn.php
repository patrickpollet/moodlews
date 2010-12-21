<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllGroupingsReturn {
	/** 
	* @var groupingRecord[]
	*/
	public $groupings;

	/**
	* default constructor for class getAllGroupingsReturn
	* @return getAllGroupingsReturn
	*/	 public function getAllGroupingsReturn() {
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
