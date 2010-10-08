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
	/* full constructor */
	 public function getRolesReturn($roles=array()){
		 $this->roles=$roles   ;
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
