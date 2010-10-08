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
	/* full constructor */
	 public function editGroupsOutput($groups=array()){
		 $this->groups=$groups   ;
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
