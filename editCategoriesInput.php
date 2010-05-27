<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCategoriesInput {
	/** 
	* @var  (categoryData) array of categoryDatum
	*/
	public $categories;
	 public function editCategoriesInput() {
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
