<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editPagesWikiOutput {
	/** 
	* @var  (pageWikiRecords) array of pageWikiRecord
	*/
	public $pagesWiki;
	 public function editPagesWikiOutput() {
		 $this->pagesWiki=array();
	}
	/* get accessors */
	public function getPagesWiki(){
		 return $this->pagesWiki;
	}

	/*set accessors */
	public function setPagesWiki($pagesWiki){
		$this->pagesWiki=$pagesWiki;
	}

}

?>
