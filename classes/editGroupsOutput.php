<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupsOutput {
	/** 
	* @var groupRecord[]
	*/
	public $groups;

	/**
	* default constructor for class editGroupsOutput
	* @return editGroupsOutput
	*/	 public function editGroupsOutput() {
		 $this->groups=array();
	}
	/* get accessors */

	/**
	* @return groupRecord[]
	*/
	public function getGroups(){
		 return $this->groups;
	}

	/*set accessors */

	/**
	* @param groupRecord[] $groups
	* @return void
	*/
	public function setGroups($groups){
		$this->groups=$groups;
	}

}

?>
