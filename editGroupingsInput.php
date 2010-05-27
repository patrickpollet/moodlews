<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsInput {
	/** 
	* @var  (groupingData) array of groupDatum
	*/
	public $groupings;
	 public function editGroupingsInput() {
		 $this->groupings=array();
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
