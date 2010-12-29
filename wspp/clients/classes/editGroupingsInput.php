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
	* @param groupDatum[] $groupings
	* @return editGroupingsInput
	*/
	 public function editGroupingsInput($groupings=array()){
		 $this->groupings=$groupings   ;
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
