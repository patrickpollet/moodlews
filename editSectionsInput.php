<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editSectionsInput {
	/** 
	* @var  (sectionData) array of sectionDatum
	*/
	public $sections;
	 public function editSectionsInput() {
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
