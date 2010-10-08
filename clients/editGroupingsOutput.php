<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsOutput {
	/** 
	* @var groupingRecord[]
	*/
	public $groupings;
	/* full constructor */
	 public function editGroupingsOutput($groupings=array()){
		 $this->groupings=$groupings   ;
	}
	/* get accessors */
	public function getGroupings(){
		 return $this->groupings;
	}

	/*set accessors */
	public function setGroupings($groupings){
		$this->groupings=$groupings;
	}

}

?>
