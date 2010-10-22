<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getGroupingsReturn {
	/** 
	* @var groupingRecord[]
	*/
	public $groupings;
	 public function getGroupingsReturn() {
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
