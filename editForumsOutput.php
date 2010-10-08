<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editForumsOutput {
	/** 
	* @var forumRecord[]
	*/
	public $forums;
	 public function editForumsOutput() {
		 $this->forums=array();
	}
	/* get accessors */
	public function getForums(){
		 return $this->forums;
	}

	/*set accessors */
	public function setForums($forums){
		$this->forums=$forums;
	}

}

?>
