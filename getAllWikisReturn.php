<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllWikisReturn {
	/** 
	* @var  (wikiRecords) array of wikiRecord
	*/
	public $wikis;
	 public function getAllWikisReturn() {
		 $this->wikis=array();
	}
	/* get accessors */
	public function getWikis(){
		 return $this->wikis;
	}

	/*set accessors */
	public function setWikis($wikis){
		$this->wikis=$wikis;
	}

}

?>
