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
	* @param sectionRecord[] $sections
	* @return editSectionsOutput
	*/
	 public function editSectionsOutput($sections=array()){
		 $this->sections=$sections   ;
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
