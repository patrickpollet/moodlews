<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class roleRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $shortname;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  integer
	*/
	public $sortorder;
	/* constructor */
	 public function roleRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->name='';
		 $this->shortname='';
		 $this->description='';
		 $this->sortorder=0;
	}
}

?>
