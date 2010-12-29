<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllLabelsReturn {
	/** 
	* @var labelRecord[]
	*/
	public $labels;

	/**
	* default constructor for class getAllLabelsReturn
	* @return getAllLabelsReturn
	*/	 public function getAllLabelsReturn() {
		 $this->labels=array();
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
