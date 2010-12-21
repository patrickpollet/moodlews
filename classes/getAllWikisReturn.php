<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllWikisReturn {
	/** 
	* @var wikiRecord[]
	*/
	public $wikis;

	/**
	* default constructor for class getAllWikisReturn
	* @return getAllWikisReturn
	*/	 public function getAllWikisReturn() {
		 $this->wikis=array();
	}
	/* get accessors */

	/**
	* @return wikiRecord[]
	*/
	public function getWikis(){
		 return $this->wikis;
	}

	/*set accessors */

	/**
	* @param wikiRecord[] $wikis
	* @return void
	*/
	public function setWikis($wikis){
		$this->wikis=$wikis;
	}

}

?>
