<?php
/**
 * 
 * 
 * @package	MoodleWS
 * @copyright	(c) P.Pollet 2007 under GPL
 */
class activityRecord {
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
	public $time;
	/** 
	* @var  integer
	*/
	public $userid;
	/** 
	* @var  string
	*/
	public $ip;
	/** 
	* @var  integer
	*/
	public $course;
	/** 
	* @var  integer
	*/
	public $module;
	/** 
	* @var  integer
	*/
	public $cmid;
	/** 
	* @var  string
	*/
	public $action;
	/** 
	* @var  string
	*/
	public $url;
	/** 
	* @var  string
	*/
	public $info;
	/** 
	* @var  string
	*/
	public $DATE;
	/** 
	* @var  string
	*/
	public $auth;
	/** 
	* @var  string
	*/
	public $firstname;
	/** 
	* @var  string
	*/
	public $lastname;
	/** 
	* @var  string
	*/
	public $email;
	/** 
	* @var  integer
	*/
	public $firstaccess;
	/** 
	* @var  integer
	*/
	public $lastaccess;
	/** 
	* @var  integer
	*/
	public $lastlogin;
	/** 
	* @var  integer
	*/
	public $currentlogin;
	/** 
	* @var  string
	*/
	public $DLA;
	/** 
	* @var  string
	*/
	public $DFA;
	/** 
	* @var  string
	*/
	public $DLL;
	/** 
	* @var  string
	*/
	public $DCL;
	/* constructor */
	 public function activityRecord() {
		 $this->error='';
		 $this->id=0;
		 $this->time=0;
		 $this->userid=0;
		 $this->ip='';
		 $this->course=0;
		 $this->module=0;
		 $this->cmid=0;
		 $this->action='';
		 $this->url='';
		 $this->info='';
		 $this->DATE='';
		 $this->auth='';
		 $this->firstname='';
		 $this->lastname='';
		 $this->email='';
		 $this->firstaccess=0;
		 $this->lastaccess=0;
		 $this->lastlogin=0;
		 $this->currentlogin=0;
		 $this->DLA='';
		 $this->DFA='';
		 $this->DLL='';
		 $this->DCL='';
	}
}

?>
