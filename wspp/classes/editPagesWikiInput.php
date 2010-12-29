<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editPagesWikiInput {
	/** 
	* @var pageWikiDatum[]
	*/
	public $pagesWiki;

	/**
	* default constructor for class editPagesWikiInput
	* @return editPagesWikiInput
	*/	 public function editPagesWikiInput() {
		 $this->pagesWiki=array();
	}
	/* get accessors */

	/**
	* @return pageWikiDatum[]
	*/
	public function getPagesWiki(){
		 return $this->pagesWiki;
	}

	/*set accessors */

	/**
	* @param pageWikiDatum[] $pagesWiki
	* @return void
	*/
	public function setPagesWiki($pagesWiki){
		$this->pagesWiki=$pagesWiki;
	}

}

?>
