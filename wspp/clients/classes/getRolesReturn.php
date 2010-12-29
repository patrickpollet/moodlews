<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getRolesReturn {
	/** 
	* @var roleRecord[]
	*/
	public $roles;

	/**
	* default constructor for class getRolesReturn
	* @param roleRecord[] $roles
	* @return getRolesReturn
	*/
	 public function getRolesReturn($roles=array()){
		 $this->roles=$roles   ;
	}
	/* get accessors */

	/**
	* @return roleRecord[]
	*/
	public function getRoles(){
		 return $this->roles;
	}

	/*set accessors */

	/**
	* @param roleRecord[] $roles
	* @return void
	*/
	public function setRoles($roles){
		$this->roles=$roles;
	}

}

?>
