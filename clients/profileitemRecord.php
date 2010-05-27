<?php
/**
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class profileitemRecord {
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $value;
	/* full constructor */
	 public function profileitemRecord($name='',$value=''){
		 $this->name=$name   ;
		 $this->value=$value   ;
	}
	/* get accessors */
	public function getName(){
		 return $this->name;
	}

	public function getValue(){
		 return $this->value;
	}

	/*set accessors */
	public function setName($name){
		$this->name=$name;
	}

	public function setValue($value){
		$this->value=$value;
	}

}

?>
