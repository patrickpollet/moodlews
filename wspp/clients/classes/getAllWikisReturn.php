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
	* @param wikiRecord[] $wikis
	* @return getAllWikisReturn
	*/
	 public function getAllWikisReturn($wikis=array()){
		 $this->wikis=$wikis   ;
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
