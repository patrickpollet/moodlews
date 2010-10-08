<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editLabelsInput {
	/** 
	* @var labelDatum[]
	*/
	public $labels;
	 public function editLabelsInput() {
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
