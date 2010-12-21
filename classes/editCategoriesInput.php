<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCategoriesInput {
	/** 
	* @var categoryDatum[]
	*/
	public $categories;

	/**
	* default constructor for class editCategoriesInput
	* @return editCategoriesInput
	*/	 public function editCategoriesInput() {
		 $this->categories=array();
	}
	/* get accessors */

	/**
	* @return categoryDatum[]
	*/
	public function getCategories(){
		 return $this->categories;
	}

	/*set accessors */

	/**
	* @param categoryDatum[] $categories
	* @return void
	*/
	public function setCategories($categories){
		$this->categories=$categories;
	}

}

?>
