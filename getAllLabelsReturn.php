<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllLabelsReturn {
	/** 
	* @var  (labelRecords) array of labelRecord
	*/
	public $labels;
	 public function getAllLabelsReturn() {
		 $this->labels=array();
	}
	/* get accessors */
	public function getLabels(){
		 return $this->labels;
	}

	/*set accessors */
	public function setLabels($labels){
		$this->labels=$labels;
	}

}

?>
