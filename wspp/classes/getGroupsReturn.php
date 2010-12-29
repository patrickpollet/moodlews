<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGroupsReturn {
	/** 
	* @var groupRecord[]
	*/
	public $groups;

	/**
	* default constructor for class getGroupsReturn
	* @return getGroupsReturn
	*/	 public function getGroupsReturn() {
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
