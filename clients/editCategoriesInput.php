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
	/* full constructor */
	 public function editCategoriesInput($categories=array()){
		 $this->categories=$categories   ;
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
