<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getResourcesReturn {
	/** 
	* @var  (resourceRecords) array of resourceRecord
	*/
	public $resources;
	/* full constructor */
	 public function getResourcesReturn($resources=array()){
		 $this->resources=$resources   ;
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
