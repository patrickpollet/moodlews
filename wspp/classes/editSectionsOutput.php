<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editSectionsOutput {
	/** 
	* @var sectionRecord[]
	*/
	public $sections;

	/**
	* default constructor for class editSectionsOutput
	* @return editSectionsOutput
	*/	 public function editSectionsOutput() {
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
