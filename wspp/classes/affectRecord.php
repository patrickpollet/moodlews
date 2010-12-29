<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class affectRecord {
	/** 
	* @var string
	*/
	public $error;
	/** 
	* @var boolean
	*/
	public $status;

	/**
	* default constructor for class affectRecord
	* @return affectRecord
	*/	 public function affectRecord() {
		 $this->error='';
		 $this->status=false;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getError(){
		 return $this->error;
	}


	/**
	* @return boolean
	*/
	public function getStatus(){
		 return $this->status;
	}

	/*set accessors */

	/**
	* @param string $error
	* @return void
	*/
	public function setError($error){
		$this->error=$error;
	}


	/**
	* @param boolean $status
	* @return void
	*/
	public function setStatus($status){
		$this->status=$status;
	}

}

?>
