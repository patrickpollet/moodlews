<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getAllPagesWikiReturn {
	/** 
	* @var  (pageWikiRecords) array of pageWikiRecord
	*/
	public $pageswiki;
	/* full constructor */
	 public function getAllPagesWikiReturn($pageswiki=array()){
		 $this->pageswiki=$pageswiki   ;
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
