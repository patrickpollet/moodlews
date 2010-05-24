<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class setUserProfileValuesReturn {
	/** 
	* @var  (profileitemRecords) array of profileitemRecord
	*/
	public $profiles;
	 public function setUserProfileValuesReturn() {
		 $this->profiles=array();
	}
	/* get accessors */
	public function getProfiles(){
		 return $this->profiles;
	}

	/*set accessors */
	public function setProfiles($profiles){
		$this->profiles=$profiles;
	}

}

?>
