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

	/**
	* default constructor for class editForumsOutput
	* @return editForumsOutput
	*/	 public function editForumsOutput() {
		 $this->forums=array();
	}
	/* get accessors */

	/**
	* @return forumRecord[]
	*/
	public function getForums(){
		 return $this->forums;
	}

	/*set accessors */

	/**
	* @param forumRecord[] $forums
	* @return void
	*/
	public function setForums($forums){
		$this->forums=$forums;
	}

}

?>
