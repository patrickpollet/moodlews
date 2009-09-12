<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGroupsReturn {
	/** 
	* @var  (groupRecords) array of groupRecord
	*/
	public $groups;
	 public function getGroupsReturn() {
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
