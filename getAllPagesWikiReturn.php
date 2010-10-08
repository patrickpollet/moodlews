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
	 public function getAllPagesWikiReturn() {
		 $this->pageswiki=array();
	}
	/* get accessors */
	public function getPageswiki(){
		 return $this->pageswiki;
	}

	/*set accessors */
	public function setPageswiki($pageswiki){
		$this->pageswiki=$pageswiki;
	}

}

?>
