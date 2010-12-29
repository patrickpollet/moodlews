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

	/**
	* default constructor for class editLabelsInput
	* @return editLabelsInput
	*/	 public function editLabelsInput() {
		 $this->labels=array();
	}
	/* get accessors */

	/**
	* @return labelDatum[]
	*/
	public function getLabels(){
		 return $this->labels;
	}

	/*set accessors */

	/**
	* @param labelDatum[] $labels
	* @return void
	*/
	public function setLabels($labels){
		$this->labels=$labels;
	}

}

?>
