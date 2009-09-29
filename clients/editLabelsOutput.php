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
	/* full constructor */
	 public function editLabelsOutput($labels=array()){
		 $this->labels=$labels   ;
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
