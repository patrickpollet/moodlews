<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getRolesReturn {
	/** 
	* @var  (roleRecords) array of roleRecord
	*/
	public $roles;
	 public function getRolesReturn() {
		 $this->roles=array();
	}
	/* get accessors */
	public function getRoles(){
		 return $this->roles;
	}

	/*set accessors */
	public function setRoles($roles){
		$this->roles=$roles;
	}

}

?>
