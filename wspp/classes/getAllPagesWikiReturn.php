<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllPagesWikiReturn {
	/** 
	* @var pageWikiRecord[]
	*/
	public $pageswiki;

	/**
	* default constructor for class getAllPagesWikiReturn
	* @return getAllPagesWikiReturn
	*/	 public function getAllPagesWikiReturn() {
		 $this->pageswiki=array();
	}
	/* get accessors */

	/**
	* @return pageWikiRecord[]
	*/
	public function getPageswiki(){
		 return $this->pageswiki;
	}

	/*set accessors */

	/**
	* @param pageWikiRecord[] $pageswiki
	* @return void
	*/
	public function setPageswiki($pageswiki){
		$this->pageswiki=$pageswiki;
	}

}

?>
