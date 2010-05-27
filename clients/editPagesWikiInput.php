<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editPagesWikiInput {
	/** 
	* @var  (pageWikiData) array of pageWikiDatum
	*/
	public $pagesWiki;
	/* full constructor */
	 public function editPagesWikiInput($pagesWiki=array()){
		 $this->pagesWiki=$pagesWiki   ;
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
