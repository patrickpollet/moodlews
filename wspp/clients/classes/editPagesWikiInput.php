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
	* @param pageWikiDatum[] $pagesWiki
	* @return editPagesWikiInput
	*/
	 public function editPagesWikiInput($pagesWiki=array()){
		 $this->pagesWiki=$pagesWiki   ;
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
