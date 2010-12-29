<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getResourcesReturn {
	/** 
	* @var resourceRecord[]
	*/
	public $resources;

	/**
	* default constructor for class getResourcesReturn
	* @param resourceRecord[] $resources
	* @return getResourcesReturn
	*/
	 public function getResourcesReturn($resources=array()){
		 $this->resources=$resources   ;
	}
	/* get accessors */

	/**
	* @return resourceRecord[]
	*/
	public function getResources(){
		 return $this->resources;
	}

	/*set accessors */

	/**
	* @param resourceRecord[] $resources
	* @return void
	*/
	public function setResources($resources){
		$this->resources=$resources;
	}

}

?>
