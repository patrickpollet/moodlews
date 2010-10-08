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
	 public function editGroupsInput() {
		 $this->groups=array();
	}
	/* get accessors */
	public function getGroups(){
		 return $this->groups;
	}

	/*set accessors */
	public function setGroups($groups){
		$this->groups=$groups;
	}

}

?>
