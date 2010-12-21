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
	* @param forumRecord[] $forums
	* @return getAllForumsReturn
	*/
	 public function getAllForumsReturn($forums=array()){
		 $this->forums=$forums   ;
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
