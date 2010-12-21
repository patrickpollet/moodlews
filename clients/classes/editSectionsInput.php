<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class editSectionsInput {
	/** 
	* @var sectionDatum[]
	*/
	public $sections;

	/**
	* default constructor for class editSectionsInput
	* @param sectionDatum[] $sections
	* @return editSectionsInput
	*/
	 public function editSectionsInput($sections=array()){
		 $this->sections=$sections   ;
	}
	/* get accessors */

	/**
	* @return sectionDatum[]
	*/
	public function getSections(){
		 return $this->sections;
	}

	/*set accessors */

	/**
	* @param sectionDatum[] $sections
	* @return void
	*/
	public function setSections($sections){
		$this->sections=$sections;
	}

}

?>
