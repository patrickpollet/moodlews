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
	* @param wikiDatum[] $wikis
	* @return editWikisInput
	*/
	 public function editWikisInput($wikis=array()){
		 $this->wikis=$wikis   ;
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
