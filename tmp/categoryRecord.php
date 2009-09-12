<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class categoryRecord {
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
	public $description;
	/** 
	* @var  integer
	*/
	public $parent;
	/** 
	* @var  integer
	*/
	public $sortorder;
	/** 
	* @var  integer
	*/
	public $coursecount;
	/** 
	* @var  integer
	*/
	public $visible;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/** 
	* @var  integer
	*/
	public $depth;
	/** 
	* @var  string
	*/
	public $path;
	/* constructor */
	 public function categoryRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->name='';
		 $this->description='';
		 $this->parent=0;
		 $this->sortorder=0;
		 $this->coursecount=0;
		 $this->visible=0;
		 $this->timemodified=0;
		 $this->depth=0;
		 $this->path='';
	}
}

?>
