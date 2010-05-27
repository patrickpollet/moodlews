<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class affectRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  boolean
	*/
	public $status;
	 public function affectRecord() {
		 $this->error='';
		 $this->status=false;
	}
	/* get accessors */
	public function getError(){
		 return $this->error;
	}

	public function getStatus(){
		 return $this->status;
	}

	/*set accessors */
	public function setError($error){
		$this->error=$error;
	}

	public function setStatus($status){
		$this->status=$status;
	}

}

?>
