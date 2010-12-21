<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupsInput {
	/** 
	* @var groupDatum[]
	*/
	public $groups;

	/**
	* default constructor for class editGroupsInput
	* @param groupDatum[] $groups
	* @return editGroupsInput
	*/
	 public function editGroupsInput($groups=array()){
		 $this->groups=$groups   ;
	}
	/* get accessors */

	/**
	* @return groupDatum[]
	*/
	public function getGroups(){
		 return $this->groups;
	}

	/*set accessors */

	/**
	* @param groupDatum[] $groups
	* @return void
	*/
	public function setGroups($groups){
		$this->groups=$groups;
	}

}

?>
