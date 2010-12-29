<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllForumsReturn {
	/** 
	* @var forumRecord[]
	*/
	public $forums;

	/**
	* default constructor for class getAllForumsReturn
	* @return getAllForumsReturn
	*/	 public function getAllForumsReturn() {
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
