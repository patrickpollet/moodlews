<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editForumsInput {
	/** 
	* @var forumDatum[]
	*/
	public $forums;

	/**
	* default constructor for class editForumsInput
	* @return editForumsInput
	*/	 public function editForumsInput() {
		 $this->forums=array();
	}
	/* get accessors */

	/**
	* @return forumDatum[]
	*/
	public function getForums(){
		 return $this->forums;
	}

	/*set accessors */

	/**
	* @param forumDatum[] $forums
	* @return void
	*/
	public function setForums($forums){
		$this->forums=$forums;
	}

}

?>
