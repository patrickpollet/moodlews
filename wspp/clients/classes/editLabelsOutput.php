<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editLabelsOutput {
	/** 
	* @var labelRecord[]
	*/
	public $labels;

	/**
	* default constructor for class editLabelsOutput
	* @param labelRecord[] $labels
	* @return editLabelsOutput
	*/
	 public function editLabelsOutput($labels=array()){
		 $this->labels=$labels   ;
	}
	/* get accessors */

	/**
	* @return labelRecord[]
	*/
	public function getLabels(){
		 return $this->labels;
	}

	/*set accessors */

	/**
	* @param labelRecord[] $labels
	* @return void
	*/
	public function setLabels($labels){
		$this->labels=$labels;
	}

}

?>
