<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class groupRecord {
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
	* @var  string
	*/
	public $name;
	/** 
	* @var  string
	*/
	public $description;
	/** 
	* @var  string
	*/
	public $lang;
	/** 
	* @var  string
	*/
	public $theme;
	/** 
	* @var  integer
	*/
	public $picture;
	/** 
	* @var  integer
	*/
	public $hidepicture;
	/** 
	* @var  integer
	*/
	public $timecreated;
	/** 
	* @var  integer
	*/
	public $timemodified;
	/* constructor */
	 public function groupRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->courseid=0;
		 $this->name='';
		 $this->description='';
		 $this->lang='';
		 $this->theme='';
		 $this->picture=0;
		 $this->hidepicture=0;
		 $this->timecreated=0;
		 $this->timemodified=0;
	}
}

?>
