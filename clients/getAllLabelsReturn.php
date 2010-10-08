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
	/* full constructor */
	 public function getAllLabelsReturn($labels=array()){
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
