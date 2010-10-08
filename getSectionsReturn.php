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
	 public function getSectionsReturn() {
		 $this->sections=array();
	}
	/* get accessors */
	public function getSections(){
		 return $this->sections;
	}

	/*set accessors */
	public function setSections($sections){
		$this->sections=$sections;
	}

}

?>
