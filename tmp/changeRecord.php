<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class changeRecord {
	/** 
	* @var  string
	*/
	public $error;
	/** 
	* @var  integer
	*/
	public $id;
	/** 
	* @var  integer
	*/
	public $courseid;
	/** 
	* @var  integer
	*/
	public $instance;
	/** 
	* @var  integer
	*/
	public $resid;
	/** 
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $date;
	/** 
	* @var  integer
	*/
	public $timestamp;
	/** 
	* @var  string
	*/
	public $type;
	/** 
	* @var  string
	*/
	public $author;
	/** 
	* @var  string
	*/
	public $link;
	/** 
	* @var  string
	*/
	public $url;
	/** 
	* @var  integer
	*/
	public $visible;
	/* constructor */
	 public function changeRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->courseid=0;
		 $this->instance=0;
		 $this->resid=0;
		 $this->name='';
		 $this->date='';
		 $this->timestamp=0;
		 $this->type='';
		 $this->author='';
		 $this->link='';
		 $this->url='';
		 $this->visible=0;
	}
}

?>
