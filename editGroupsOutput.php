<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupsOutput {
	/** 
	* @var  (groupRecords) array of groupRecord
	*/
	public $groups;
	 public function editGroupsOutput() {
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
