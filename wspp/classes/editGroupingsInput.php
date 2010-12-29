<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsInput {
	/** 
	* @var groupDatum[]
	*/
	public $groupings;

	/**
	* default constructor for class editGroupingsInput
	* @return editGroupingsInput
	*/	 public function editGroupingsInput() {
		 $this->groupings=array();
	}
	/* get accessors */

	/**
	* @return groupDatum[]
	*/
	public function getGroupings(){
		 return $this->groupings;
	}

	/*set accessors */

	/**
	* @param groupDatum[] $groupings
	* @return void
	*/
	public function setGroupings($groupings){
		$this->groupings=$groupings;
	}

}

?>
