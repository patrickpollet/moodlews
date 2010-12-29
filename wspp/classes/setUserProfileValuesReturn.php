<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class setUserProfileValuesReturn {
	/** 
	* @var profileitemRecord[]
	*/
	public $profiles;

	/**
	* default constructor for class setUserProfileValuesReturn
	* @return setUserProfileValuesReturn
	*/	 public function setUserProfileValuesReturn() {
		 $this->profiles=array();
	}
	/* get accessors */

	/**
	* @return profileitemRecord[]
	*/
	public function getProfiles(){
		 return $this->profiles;
	}

	/*set accessors */

	/**
	* @param profileitemRecord[] $profiles
	* @return void
	*/
	public function setProfiles($profiles){
		$this->profiles=$profiles;
	}

}

?>
