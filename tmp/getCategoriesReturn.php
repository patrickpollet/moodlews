<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getCategoriesReturn {
	/** 
	* @var  categoryRecords
	*/
	public $categories;
	/* constructor */
	 public function getCategoriesReturn() {
		 $this->categories=new categoryRecords();
	}
}

?>
