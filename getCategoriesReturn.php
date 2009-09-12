<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getCategoriesReturn {
	/** 
	* @var  (categoryRecords) array of categoryRecord
	*/
	public $categories;
	 public function getCategoriesReturn() {
		 $this->categories=array();
	}
	/* get accessors */
	public function getCategories(){
		 return $this->categories;
	}

	/*set accessors */
	public function setCategories($categories){
		$this->categories=$categories;
	}

}

?>
