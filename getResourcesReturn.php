<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getResourcesReturn {
	/** 
	* @var  (resourceRecords) array of resourceRecord
	*/
	public $resources;
	 public function getResourcesReturn() {
		 $this->resources=array();
	}
	/* get accessors */
	public function getResources(){
		 return $this->resources;
	}

	/*set accessors */
	public function setResources($resources){
		$this->resources=$resources;
	}

}

?>
