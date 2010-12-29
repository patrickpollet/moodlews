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
	* @param profileitemRecord[] $profiles
	* @return setUserProfileValuesReturn
	*/
	 public function setUserProfileValuesReturn($profiles=array()){
		 $this->profiles=$profiles   ;
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
