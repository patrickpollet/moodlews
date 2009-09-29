<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editLabelsInput {
	/** 
	* @var  (labelData) array of labelDatum
	*/
	public $labels;
	/* full constructor */
	 public function editLabelsInput($labels=array()){
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
