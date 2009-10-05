<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllGroupingsReturn {
	/** 
	* @var  (groupingRecords) array of groupingRecord
	*/
	public $groupings;
	/* full constructor */
	 public function getAllGroupingsReturn($groupings=array()){
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
