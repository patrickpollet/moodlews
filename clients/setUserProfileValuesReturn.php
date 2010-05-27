<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class setUserProfileValuesReturn {
	/** 
	* @var  (profileitemRecords) array of profileitemRecord
	*/
	public $profiles;
	/* full constructor */
	 public function setUserProfileValuesReturn($profiles=array()){
		 $this->profiles=$profiles   ;
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
