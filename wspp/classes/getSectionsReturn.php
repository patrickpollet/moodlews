<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getSectionsReturn {
	/** 
	* @var sectionRecord[]
	*/
	public $sections;

	/**
	* default constructor for class getSectionsReturn
	* @return getSectionsReturn
	*/	 public function getSectionsReturn() {
		 $this->sections=array();
	}
	/* get accessors */

	/**
	* @return sectionRecord[]
	*/
	public function getSections(){
		 return $this->sections;
	}

	/*set accessors */

	/**
	* @param sectionRecord[] $sections
	* @return void
	*/
	public function setSections($sections){
		$this->sections=$sections;
	}

}

?>
