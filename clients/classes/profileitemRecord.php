<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class profileitemRecord {
	/** 
	* @var string
	*/
	public $name;
	/** 
	* @var string
	*/
	public $value;

	/**
	* default constructor for class profileitemRecord
	* @param string $name
	* @param string $value
	* @return profileitemRecord
	*/
	 public function profileitemRecord($name='',$value=''){
		 $this->name=$name   ;
		 $this->value=$value   ;
	}
	/* get accessors */

	/**
	* @return string
	*/
	public function getName(){
		 return $this->name;
	}


	/**
	* @return string
	*/
	public function getValue(){
		 return $this->value;
	}

	/*set accessors */

	/**
	* @param string $name
	* @return void
	*/
	public function setName($name){
		$this->name=$name;
	}


	/**
	* @param string $value
	* @return void
	*/
	public function setValue($value){
		$this->value=$value;
	}

}

?>
