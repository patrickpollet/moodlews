<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class getLastChangesReturn {
	/** 
	* @var changeRecord[]
	*/
	public $changes;
	/* full constructor */
	 public function getLastChangesReturn($changes=array()){
		 $this->changes=$changes   ;
	}
	/* get accessors */
	public function getChanges(){
		 return $this->changes;
	}

	/*set accessors */
	public function setChanges($changes){
		$this->changes=$changes;
	}

}

?>
