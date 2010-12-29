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
	* @param labelRecord[] $labels
	* @return getAllLabelsReturn
	*/
	 public function getAllLabelsReturn($labels=array()){
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
