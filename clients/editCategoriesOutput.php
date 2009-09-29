<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editCategoriesOutput {
	/** 
	* @var  (categoryRecords) array of categoryRecord
	*/
	public $categories;
	/* full constructor */
	 public function editCategoriesOutput($categories=array()){
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
