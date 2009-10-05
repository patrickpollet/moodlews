<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editGroupingsInput {
	/** 
	* @var  (groupingData) array of groupDatum
	*/
	public $groupings;
	/* full constructor */
	 public function editGroupingsInput($groupings=array()){
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
