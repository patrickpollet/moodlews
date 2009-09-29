<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editLabelsOutput {
	/** 
	* @var  (labelRecords) array of labelRecord
	*/
	public $labels;
	 public function editLabelsOutput() {
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
