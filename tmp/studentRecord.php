<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class studentRecord {
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  integer
	*/
	public $timestart;
	/** 
	* @var  integer
	*/
	public $timeend;
	/** 
	* @var  integer
	*/
	public $timeaccess;
	/** 
	* @var  string
	*/
	public $enrol;
	/* constructor */
	 public function studentRecord() {
		 $this->userid=0;
		 $this->course=0;
		 $this->timestart=0;
		 $this->timeend=0;
		 $this->timeaccess=0;
		 $this->enrol='';
	}
}

?>
