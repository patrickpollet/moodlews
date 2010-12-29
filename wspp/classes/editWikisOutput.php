<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editWikisOutput {
	/** 
	* @var wikiRecord[]
	*/
	public $wikis;

	/**
	* default constructor for class editWikisOutput
	* @return editWikisOutput
	*/	 public function editWikisOutput() {
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
