<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getCategoriesReturn {
	/** 
	* @var categoryRecord[]
	*/
	public $categories;

	/**
	* default constructor for class getCategoriesReturn
	* @return getCategoriesReturn
	*/	 public function getCategoriesReturn() {
		 $this->categories=array();
	}
	/* get accessors */

	/**
	* @return categoryRecord[]
	*/
	public function getCategories(){
		 return $this->categories;
	}

	/*set accessors */

	/**
	* @param categoryRecord[] $categories
	* @return void
	*/
	public function setCategories($categories){
		$this->categories=$categories;
	}

}

?>
