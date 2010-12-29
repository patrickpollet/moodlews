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
	* @param categoryRecord[] $categories
	* @return getCategoriesReturn
	*/
	 public function getCategoriesReturn($categories=array()){
		 $this->categories=$categories   ;
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
