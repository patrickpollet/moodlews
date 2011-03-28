<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getMessageContactsReturn {
	/** 
	* @var contactRecord[]
	*/
	public $contacts;

	/**
	* default constructor for class getMessageContactsReturn
	* @param contactRecord[] $contacts
	* @return getMessageContactsReturn
	*/
	 public function getMessageContactsReturn($contacts=array()){
		 $this->contacts=$contacts   ;
	}
	/* get accessors */

	/**
	* @return contactRecord[]
	*/
	public function getContacts(){
		 return $this->contacts;
	}

	/*set accessors */

	/**
	* @param contactRecord[] $contacts
	* @return void
	*/
	public function setContacts($contacts){
		$this->contacts=$contacts;
	}

}

?>
