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
	 public function editWikisOutput() {
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
