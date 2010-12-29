<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editWikisInput {
	/** 
	* @var wikiDatum[]
	*/
	public $wikis;

	/**
	* default constructor for class editWikisInput
	* @return editWikisInput
	*/	 public function editWikisInput() {
		 $this->wikis=array();
	}
	/* get accessors */

	/**
	* @return wikiDatum[]
	*/
	public function getWikis(){
		 return $this->wikis;
	}

	/*set accessors */

	/**
	* @param wikiDatum[] $wikis
	* @return void
	*/
	public function setWikis($wikis){
		$this->wikis=$wikis;
	}

}

?>
